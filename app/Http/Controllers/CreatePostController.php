<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Pokemon;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreatePostController extends Controller
{
    public function create()
    {
        $pokemons = $this->loadJsonData('pokemons.json');
        $tms = $this->loadJsonData('tms.json');
        $stones = $this->loadJsonData('stones.json');
        $pokeballs = $this->loadJsonData('pokeballs.json');

        return view('create_post', compact('pokemons', 'tms', 'stones', 'pokeballs'));
    }

    private function loadJsonData($filename)
    {
        $path = storage_path("app/game_data/$filename");
        
        if (!file_exists($path)) {
            return [];
        }

        $jsonContent = file_get_contents($path);
        
        if (empty($jsonContent)) {
            return [];
        }

        $data = json_decode($jsonContent, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }

        return collect($data['_default'] ?? [])->pluck('name')->toArray();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:25',
            'description' => 'required|min:2|max:1000',
            'items' => 'required|json',
        ]);

        $items = json_decode($request->items, true);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        foreach ($items as $item) {
            if ($item['type'] === 'pokemon') {

                $request->validate([
                    'name' => 'required|min:2|max:25',
                    'level' => 'required|min:2|max:25',
                    'nature' => 'required|min:2|max:25',
                    'pokeball' => 'required|min:2|max:25',
                    'addon' => 'required|min:2|max:25',
                    'boost' => 'required|min:2|max:25',
                    'price' => 'required|min:2|max:25',
                ]);

                Pokemon::create([
                    'post_id' => $post->id,  // Make sure this line is present
                    'name' => $item['name'],
                    'level' => $item['level'],
                    'nature' => $item['nature'],
                    'pokeball' => $item['pokeball'],
                    'addon' => $item['addon'],
                    'boost' => $item['boost'],
                    'price' => $item['price'],
                ]);
            } else {
                Item::create([
                    'post_id' => $post->id,  // Make sure this line is present
                    'type' => $item['type'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'redirect' => route('posts.edit', $post->id)
        ]);
    }
}
