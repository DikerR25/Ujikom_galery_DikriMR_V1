@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
            @if($posts->isEmpty())
            <div class="container">
                <div class="row justify-content-center">
                    <span class="badge text-bg-warning text-light mt-4 mb-4 w-50 p-3 fs-5">Tidak ada postingan yang tersedia untuk kategori ini.</span>
                </div>
            </div>
            @else
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
                                    <span class="comment-native text-center row"><i class="fa-solid fa-comment fs-1"></i><span>{{$p->commnet}}</span></span>
                                    <span class="like-native text-center row"><i class="fa-solid fa-heart fs-1"></i><span>{{$p->like}}</span></span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
            @endif
@endsection
