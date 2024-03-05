@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    <a href="{{ route('logout') }}" class="btn bg-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout">
        <i class="fa-solid fa-left-long fs-4 text-danger"></i>
    </a>
    <div class="container mt-1 mb-5">
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card profile-card bg-black">
                    <img src="https://via.placeholder.com/150" class="rounded-circle container mt-3" style="width:50%" alt="Profile Picture">
                    <div class="card-body text-start">
                        <h5 class="card-title text-light">DikerR</h5>
                        <p class="card-text text-light">Joined Sep 6, 2023</p>
                        <p class="card-text text-light">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio, veritatis.</p>
                    </div>
                    <div class="text-center">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mb-2" style="width: 92%">Edit Profile</a>
                    </div>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col mt-3 mb-3">
                                <span class="text-light">100</span><span class="text-light"><p>Likes</p></span>
                            </div>
                            <div class="col mt-3 mb-3">
                                <span class="text-light">100</span><span class="text-light"><p>Posts</p></span>
                            </div>
                            <div class="col mt-3 mb-3">
                                <span class="text-light">100</span><span class="text-light"><p>Friends</p></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card profile-card bg-black">
                    <div class="container text-center">
                        <div class="row row-cols-3">
                            @for ($i = 0; $i < 15; $i++)
                                <div class="col">
                                    <div class="body-img-native-profile">
                                        <div class="card-native-profile mt-3 mb-2">
                                            <img src="https://i.pinimg.com/236x/ee/c9/28/eec9283201e20a8b046b42792472a02e.jpg" alt="">
                                        </div>
                                        <span class="comment-native-profile text-center row"><i class="fa-solid fa-comment fs-1"></i><span>100</span></span>
                                        <span class="like-native-profile text-center row"><i class="fa-solid fa-heart fs-1"></i><span>100</span></span>
                                    </div>
                                </div>
                            @endfor
                        </div>
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

            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
