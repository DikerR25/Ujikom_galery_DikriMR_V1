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
                            <img src="{{ Storage::url('public/posts/').$p->image }}" alt="{{ $p->title }}">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="https://i.pinimg.com/236x/22/c0/91/22c091b46f50a29446b38ff284bc6e0c.jpg" alt="">
                </div>
            </div>
            </div>
        </div>
@endsection
