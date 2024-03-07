@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    @foreach ($user as $u)
    @if ($u->id == Auth::user()->id)
    <a href="{{ route('logout') }}" class="btn bg-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout">
        <i class="fa-solid fa-left-long fs-4 text-danger"></i>
    </a>
    @else
    <div class="mb-4"></div>
    @endif
    <div class="container mt-1 mb-5">
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card profile-card bg-black card-shadow-native">
                    @if ($u->img == 'user')
                        <img src="/assets/img/avatar.png" alt="{{ $u->username }}" class="profile-native container mt-3" style="width:50%">
                    @else
                        <img src="{{ Storage::url('public/profile_photos/').$u->img }}" alt="{{ $u->username }}" class="profile-native container mt-3" style="width:50%">
                    @endif
                    <div class="card-body text-start">
                        <span class="card-title text-light fs-5">{{ $u->username }} @if ($u->type == 'verify') <i class="ms-1 fa-solid fa-circle-check text-primary"></i></span> @endif</span>
                        <p class="card-text text-light">Joined {{ $u->created_at->format('M j, Y') }}</p>
                        <p class="card-text text-light">{{ $u->description }}</p>
                    </div>
                    <div class="text-center">
                        @if ($u->id == Auth::user()->id)
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mb-2" style="width: 92%">Edit Profile</a>
                        @else
                            @php $alreadyFriends = false; @endphp
                            @foreach ($relationship1 as $r)
                                @if ($r->status == 'accepted')
                                    @php $alreadyFriends = true; @endphp
                                    <a class="btn btn-primary mb-2" style="width: 92%">Sudah Berteman!</a>
                                @endif
                            @endforeach

                            @if (!$alreadyFriends)
                                <a href="{{ route('friendship.store',['user_id' => $u->id]) }}" class="btn btn-primary mb-2" style="width: 92%">Tambah Teman</a>
                            @endif
                        @endif
                    </div>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col mt-3 mb-3">
                                <span class="text-light">{{ $totalLikes }}</span><span class="text-light"><p>Likes</p></span>
                            </div>
                            <div class="col mt-3 mb-3">
                                <span class="text-light">{{ $totalPosts }}</span><span class="text-light"><p>Posts</p></span>
                            </div>
                            <div class="col mt-3 mb-3">
                                <span class="text-light">{{ $relationship }}</span><span class="text-light"><p>Friends</p></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card profile-card bg-black card-shadow-native">
                    <div class="container text-center">
                        @if ($posts->isEmpty())
                                <span class="badge text-bg-primary text-light mt-4 mb-4 w-50 p-3 fs-5">Tidak ada postingan</span>
                            @else
                            <div class="row row-cols-3">
                                @foreach ($posts as $p)
                                <div class="col">
                                    <a href="{{ route('viewimg',['username' => $u->username, 'id' => $p->id]) }}">
                                        <div class="body-img-native-profile">
                                            <div class="card-native-profile mt-3 mb-2">
                                                <img src="{{ Storage::url('public/posts/').$p->image }}" alt="{{ $p->title }}">
                                            </div>
                                            <span class="comment-native-profile text-center row"><i class="fa-solid fa-comment fs-1"></i><span>{{$p->comment}}</span></span>
                                            <span class="like-native-profile text-center row"><i class="fa-solid fa-heart fs-1"></i><span>{{$p->like}}</span></span>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <span class="mt-5">....</span>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark text-light">
                    <form action="{{ route('updateP',['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" placeholder="Username">
                        </div>
                        <div class="form-group mt-2">
                            <textarea id="" class="form-control" placeholder="Bio" name="description">{{$u->description}}</textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="img" class="text-light">Change Avatar</label>
                            <input type="file" class="form-control" name="img">
                        </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
