@extends('layouts.default')

@section('title', 'タスク検索')

@section('content')
<div>
    @if (Auth::check())
    <p>ログイン中ユーザー：{{$user->name}}</p>
    <p>ユーザーID：{{$user->id}}</p>
    @else
    <p>ログインしてください（<a href="/login">ログイン</a>）</p>
    @endif
    <a href="/dashboard">logout</a>
</div>
<div class="add__container">
    <form action="/find" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="text" name="content" value="@if(isset($content)) {{$content}} @endif">
        <select name="tag_id">
            <option selected></option>
            @foreach($tags as $tag)
                @if(isset($tag_id) && ($tag_id == $tag->id))
                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                @else
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endif
            @endforeach
        </select>
        <button>search</button>
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
    @if(($user->id == $todo->user_id) && @isset($todo))
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
<a href="/todo">戻る</a>
@endsection
