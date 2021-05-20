@extends('layouts.app')

@section('content')


<div class="search-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="card">
                        <div class="card-header">Tweet</div>
                        <div class="card-body" id="time-line">
                        <?php $tweet = $tweets['data'] ?>
                        @include('tweet.tweetTemplate', ['tweet'=> $tweet])
                        <p class="mt-5">{{$tweet->created_at}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection