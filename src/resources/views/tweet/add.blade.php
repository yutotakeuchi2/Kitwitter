@extends('layouts.app')

@section('content')
    <h1>Tweet</h1>
    <form method="post" action="/tweet/store" class="tweet-form" enctype="multipart/form-data">
        @csrf
        <textarea name="sentence" type="text" class="tweet-textarea" cols="20"></textarea>
        <input type="file" class="tweet-image" name="image">
        <input type="submit" class="tweet-button">
    </form>
@endsection