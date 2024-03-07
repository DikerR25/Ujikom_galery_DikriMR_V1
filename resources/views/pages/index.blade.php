@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')

    <div class="wrapper-native">
        <div class="container-native">
            @foreach ($posts as $p)
            @foreach ($users as $u)
            @if ($p->user_id == $u->id)
                <div class="box-native">
                    <div class="body-img-native">
                        <a href="/{{ $u->username }}/{{ $p->id }}">
                            <img src="{{ Storage::url('public/posts/').$p->image }}" alt="{{ $p->title }}" class="lazyload">
                            <div class="creator-native">{{ $u->username }}</div>
                            <span class="comment-native text-center row"><i class="fa-solid fa-comment fs-1"></i><span>{{$p->comment}}</span></span>
                            <span class="like-native text-center row"><i class="fa-solid fa-heart fs-1"></i><span>{{$p->like}}</span></span>
                        </a>
                    </div>
                </div>
            @endif
            @endforeach
            @endforeach
        </div>
    </div>
@endsection
