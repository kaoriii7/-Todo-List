<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $tags = Tag::all();
        $user = Auth::user();
        return view('search', ['todos' => $todos, 'tags' => $tags, 'user' => $user]);
    }

    public function search(Request $request)
    {
        $todos = Todo::all();
        $tags = Tag::all();
        $user = Auth::user();

        $content = $request->input('content');
        $tag_id = $request->input('tag_id');

        $query = Todo::query();

        if($content) {
            $todos = $query->where('content', 'like', '%'.$content.'%')->get();
        }
        if($tag_id) {
            $todos = $query->where('tag_id', $tag_id)->get();
        }

        return view('search', ['content' => $content, 'tag_id' => $tag_id, 'todos' => $todos, 'tags' => $tags, 'user' => $user]);
    }
}
