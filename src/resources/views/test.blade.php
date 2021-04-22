@extends('layouts.app')
@section('content')

<p>{{basename($tweet_text->file('image'))}}</p>

<p>{{$tweet_text->sentence}}</p>
@endsection
