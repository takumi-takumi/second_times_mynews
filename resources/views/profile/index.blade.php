@extends('layouts.profileFront')

@section('title', 'プロフィール一覧')

@section('content')
    <div class="container">
        @if (!is_null($headline))
        《新着プロフィール》{{ $headline->updated_at->format('Y年m月d日') }}
        <hr color="#c0c0c0">
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title p-2" style="word-wrap:break-word">
                                <h1>{{ str_limit($headline->name, 70) }}</h1>
                                <p style="font-size:20px"> 性別：{{ $headline->gender }}</p>
                                <p style="font-size:20px"> 趣味：{{ str_limit($headline->hobby, 150) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6" style="word-wrap:break-word">
                            <p class="body mx-auto" style="font-size:20px">
                                自己紹介：<br>
                                {{ str_limit($headline->introduction, 650) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        《プロフィール一覧》
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                <div class="post">
                    <div class="row">
                        <div class="text col-md-6">
                            <div class="date">
                                {{ $post->updated_at->format('Y年m月d日') }}
                            </div>
                            <div class="title" style="word-wrap:break-word">
                                <h2 style="font-size:20px">{{ str_limit($post->name, 50) }}</h2>
                                <p style="font-size:15px"> 性別：{{ $post->gender }}</p>
                                <p style="font-size:15px"> 趣味：{{ str_limit($post->hobby, 150) }}</p>
                            </div>
                           
                        </div>
                         <div class="body mt-3" style="word-wrap:break-word">
                             <p style="font-size:15px">自己紹介：<br>
                                {{ str_limit($post->introduction, 1000) }}
                            </p>
                            </div>
                    </div>
                </div>
                <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
@endsection