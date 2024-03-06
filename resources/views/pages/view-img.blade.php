@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    @foreach ($user as $u)
    @foreach ($posts as $p)
    <div class="container">
        <button class="btn bg-dark" onclick="history.back()"><i class="fa-solid fa-left-long fs-4 text-light"></i></button>
        <div class="card card-flush bg-black mx-auto w-50 mb-5">
            <div class="card bg-black mx-auto w-100">
                <div class="card-body">
                    <div class="col">
                        <img class="profile-native-view" src="{{ Storage::url('public/profile_photos/').$u->img }}" alt="{{ $u->username }}">
                        <span class="ms-2 text-light">{{ $title }} @if ($u->type == 'verify') <i class="ms-2 fa-solid fa-circle-check text-primary"></i></span> @endif
                        @if (Auth::user()->id == $u->id)
                            <span class="badge text-bg-primary p-2 mt-2 float-end">Edit</span>
                        @else
                            <span class="badge text-bg-primary p-2 mt-2 float-end">Profile</span>
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
                            <i class="fa-solid fa-heart fs-2 text-light"></i><span class="text-light"> 100</span>
                        </div>
                        <div class="col mt-3 mb-3">
                            <i data-bs-toggle="modal" data-bs-target="#exampleModal" class="fa-solid fa-comment fs-2 text-light"></i><span class="text-light"> 25</span>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Comment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-dark">
                ...
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
