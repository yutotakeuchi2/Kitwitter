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
                        @include('tweet.tweetTemplate', ['tweet'=> $tweet, 'date_flag' => 1])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection