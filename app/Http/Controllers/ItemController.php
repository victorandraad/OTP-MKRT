<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function destroy(Item $item)
    {
        $post = $item->post;
        $this->authorize('update', $post);

        $item->delete();

        return redirect()->route('posts.edit', $post)->with('success', 'Item deleted successfully!');
    }
}
