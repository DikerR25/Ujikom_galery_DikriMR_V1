@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    @foreach($relationship as $request)
        @if ($request == 'pending')
            <p>{{ $request->user1->name }} ingin berteman dengan Anda.</p>
            <form action="{{ route('friendship.accept', $request->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">Terima Pertemanan</button>
            </form>
        @endif
    @endforeach


    @foreach ($relationship as $r)
    @foreach ($user as $u)
    @if ($r->user_id2 == Auth::user()->id)
    @if ($u->id == $r->user_id1)
    <div class="container">
        <div class="card bg-black mx-auto w-50 mt-5">
            <div class="card-body">
                <div class="col">
                    <img class="profile-native-view" src="{{ Storage::url('public/profile_photos/').$u->img }}" alt="{{ $u->username }}">
                    <span class="ms-2 text-light">{{ $u->username }}</span>
                    <span class="ms-2 text-light float-end mt-2">Berteman</span>
                </div>
            </div>
        </div>
    </div>
    @else
    @endif
    @endif
    @endforeach
    @endforeach

@endsection
