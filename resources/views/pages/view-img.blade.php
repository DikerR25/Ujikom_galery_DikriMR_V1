@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    @foreach ($user as $u)
    @foreach ($posts as $p)
    <div class="container">
        <button class="btn bg-dark" onclick="history.back()"><i class="fa-solid fa-left-long fs-4 text-light"></i></button>
        <div class="card card-flush bg-black mx-auto w-50 mb-5 card-shadow-native">
            <div class="card bg-black mx-auto w-100">
                <div class="card-body">
                    <div class="col">
                        @if ($u->img == 'user')
                            <img src="/assets/img/avatar.png" alt="{{ $u->username }}" class="profile-native-view">
                        @else
                            <img class="profile-native-view" src="{{ Storage::url('public/profile_photos/').$u->img }}" alt="{{ $u->username }}">
                        @endif
                        <span class="ms-2 text-light">{{ $title }} @if ($u->type == 'verify') <i class="ms-2 fa-solid fa-circle-check text-primary"></i></span> @endif
                        @if (Auth::user()->id == $u->id)
                            <span class="btn btn-primary p-1 px-3 mt-2 float-end" data-bs-toggle="modal" data-bs-target="#edit{{ $p->id }}">Edit</span>
                        @else
                            <a href="{{ route('profile', ['username' => $u->username]) }}" class="btn btn-primary p-1 px-3 mt-2 float-end">Profile</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card bg-black mx-auto w-100">
                <div class="card-native">
                    <img src="{{ Storage::url('public/posts/').$p->image }}" alt="{{ $p->title }}">
                </div>
            </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col mt-3 mb-3">
                            @if ($liked)
                                    <a href="{{route('unlike',['postId' => $p->id])}}" class="fa-solid fa-heart fs-2 text-danger" style="text-decoration: none"></a>
                            @else
                                    <a href="{{route('like',['postId' => $p->id])}}" class="fa-solid fa-heart fs-2 text-light" style="text-decoration: none"></a>
                            @endif
                            <span class="text-light"> {{ $likeCount }}</span>
                        </div>
                        <div class="col mt-3 mb-3">
                            <i data-bs-toggle="modal" data-bs-target="#Comment" class="fa-solid fa-comment fs-2 text-light"></i><span class="text-light"> {{$commentCount}}</span>
                        </div>
                        <div class="col mt-3 mb-3" onclick="copyUrlToClipboard()">
                            <i class="fa-solid fa-share fs-2 text-light"></i><span class="text-light"> Share</span>
                        </div>
                    </div>
                </div>
                <div class="separator border-top border-white"></div>
                <div class="card-body ">
                    <div class="row">
                        <span class="ms-2 text-light fw-bold">{{ $p->title }}</span>
                        <span class="ms-2 text-light">{{ $p->caption }}</span>
                        <span class="ms-2 fw-lighter fsx-1 small text-light">{{ $p->created_at->format('M j, Y') }}</span>
                    </div>
                </div>
        </div>
        <div class="mt-5">........</div>
    </div>
    <div class="modal fade" id="Comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark">
                    {{Auth::user()->id}}
                    @foreach ($comment as $c)
                    @foreach ($users as $u)
                        @if ($c->user_id == $u->id)
                        <div class="row justify-content-start">
                            <div class="badge text-bg-secondary w-100 text-start text-light mb-2">
                                <span class="fs-4"><img src="/assets/img/avatar.png" style="width: 5%; border-radius:50%" alt=""> {{$u->username}}</span>
                                <p class="fs-5">{{$c->comment}}</p>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    @endforeach
                    <form action="{{ route('komen',['postId' => $p->id]) }}" method="POST">
                        @csrf
                        <textarea name="comment" class="form-control" placeholder="Enter your comment"></textarea>
                        <button class="btn btn-primary mt-2 w-100" type="submit">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit{{ $p->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Edit Post</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark">
                <a href="{{ route('delete_post' ,['id' => $p->id]) }}" class="btn btn-danger w-100">Delete Post</a>
                <form action="{{ route('update_post',['id' => $p->id]) }}" method="POST">
                    @csrf
                    <div class="form-group mt-2">
                        <input type="text" class="form-control" name="title" value="{{ $p->title }}" placeholder="Title" required>
                    </div>
                    <div class="form-group mt-2">
                        <textarea id="" class="form-control" placeholder="Caption" name="caption" required>{{$p->caption}}</textarea>
                    </div>
            </div>
            <div class="modal-footer bg-dark">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="sumbit" class="btn btn-primary">Save Changes</button>
            </form>
            </div>
          </div>
        </div>
      </div>

    @endforeach
    @endforeach
@endsection
@push('img')
<script>
    function copyUrlToClipboard() {
        // Menyalin URL ke clipboard
        var dummyTextArea = document.createElement("textarea");
        document.body.appendChild(dummyTextArea);
        dummyTextArea.value = window.location.href;
        dummyTextArea.select();
        document.execCommand("copy");
        document.body.removeChild(dummyTextArea);

        // Menampilkan pesan bahwa URL telah disalin
        alert("URL telah disalin: " + window.location.href);
    }
    </script>
@endpush
@push('like')
<script src="/assets/js/like.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
