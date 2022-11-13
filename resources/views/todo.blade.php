@extends('layouts.default')

@section('title', 'Todo List')

@section('content')
@if (Auth::check())
<p>ログイン中ユーザー：{{$user->name}}</p>
<p>ユーザーID：{{$user->id}}</p>
@else
<p>ログインしてください（<a href="/login">ログイン</a>）</p>
@endif
<a href="/dashboard">logout</a>
<div class="search__container">
    <button>タスク検索</button>
    <form action="/add" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="text" name="content">
        <select name="tag_id">
            @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
        <button>追加</button>
    </form>
</div>
<table class="list">
    <tr>
        <th>作成日</th>
        <th>タスク名</th>
        <th>タグ</th>
        <th>更新</th>
        <th>削除</th>
    </tr>
    @foreach ($todos as $todo)
    @if($user->id == $todo->user_id)
        <tr>
            <td>{{$todo->created_at}}</td>
            <form action="/edit" method="post">
            @csrf
                <input type="hidden" name="id" value="{{$todo->id}}">
                <td>
                    <input type="text" name="content" value="{{$todo->content}}">
                </td>
                <td>
                    <select name="tag_id">
                        @foreach($tags as $tag)
                            @if($todo->tag->name == $tag->name)
                            <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                            @else
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td>
                    <button>更新</button>
                </td>
            </form>
            <form action="/delete" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$todo->id}}">
                <td>
                    <button>削除</button>
                </td>
            </form>
        </tr>
    @endif
    @endforeach
</table>
@endsection
