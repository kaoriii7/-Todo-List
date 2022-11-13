<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::all();
        $tags = Tag::all();
        $user = Auth::user();
        return view('todo', ['todos' => $todos, 'tags' => $tags, 'user' => $user]);
    }

    public function create(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/todo');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect('/todo');
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/todo');
    }
}
