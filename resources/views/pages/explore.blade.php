@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    <nav class="navbar mt-2 mb-2">
        <div class="container-fluid justify-content-center">
            <div id="app">
                <form action="/profile/" id="searchForm" class="d-flex" role="search">
                    <input id="searchInput" class="form-control me-2" type="search" placeholder="Search User" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                <ul class="d-none" id="userList" style="display: none;">
                    @foreach($users as $user)
                    <li class="user">{{ $user->username }}</li>
                    @endforeach
                </ul>
                <span class="card bg-black text-light mt-2 p-2" id="searchResults" style="display: none;"></span>
            </div>
        </div>
    </nav>
<div class="container">
    <div class="col">
        <div class="card explore-card bg-black card-shadow-native">
            <div class="container text-center">
                <div class="text-light fs-1">Kategori Gambar</div>
                <div class="row row-cols-3">
                    @foreach ($category as $c)
                    <div class="col mt-2 mb-2">
                        <a href="/explore/category/{{ $c->category }}">
                            <div class="body-img-native-explore">
                                <div class="card-native-explore mt-3 mb-2">
                                    <img src="{{ $c->img }}">
                                </div>
                                <div class="kategori-explore-native">{{ $c->category }}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">.....</div>
</div>
@endsection
@push('searchuser')
<script src="/assets/js/search-user.js"></script>
@endpush
