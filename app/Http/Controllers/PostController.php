<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::with(['user', 'pokemon', 'items'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|min:2|max:25',
            'description' => 'required|min:2|max:1000',
        ]);

        $post->update($request->only(['title', 'description']));

        if ($post->pokemon) {
            $request->validate([
                'pokemon_level' => 'required|integer|min:1|max:100',
                'pokemon_nature' => 'required|string|min:2|max:20',
                'pokemon_pokeball' => 'required|string',
                'pokemon_addon' => 'nullable|string|max:100',
                'pokemon_boost' => 'required|integer|min:0|max:10',
                'pokemon_price' => 'required|numeric|min:0',
            ]);

            $post->pokemon->update([
                'level' => $request->pokemon_level,
                'nature' => $request->pokemon_nature,
                'pokeball' => $request->pokemon_pokeball,
                'addon' => $request->pokemon_addon,
                'boost' => $request->pokemon_boost,
                'price' => $request->pokemon_price,
            ]);
        } elseif ($post->items->isNotEmpty()) {
            $request->validate([
                'item_quantity' => 'required|integer|min:1',
                'item_price' => 'required|numeric|min:0',
            ]);

            $post->items->first()->update([
                'quantity' => $request->item_quantity,
                'price' => $request->item_price,
            ]);
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        // Use Gate facade to check authorization
        if (Gate::denies('delete', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}
