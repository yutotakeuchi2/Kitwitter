@extends('layout.app')

@section('content')
    <h1>Tweet</h1>
    <form method="get" action="/tweet/add" class="tweet-form">
    <textarea name="tweet-text" class="tweet-textarea" cols="30" rows="10"></textarea>
    <input type="submit" class="tweet-button">
    </form>
@endsection