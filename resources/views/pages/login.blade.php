@extends('layouts.main-auth')

@section('kontent')
    <div class="container">
        <div class="card mx-auto w-50 mt-5 bg-black">
            <h2 class="card-title text-center mt-4 text-light">Galery Foto</h2>
        <div class="card-body">
            <div class="card mx-auto w-100 bg-dark">
            <div class="card-body">
                <form action="{{ route('proseslogin') }}" method="POST">
                    @csrf
                <div class="form-group flex-nowrap mb-2">
                    <input type="text" class="form-control" name="email" placeholder="Email" aria-describedby="addon-wrapping">
                </div>
                <div class="form-group flex-nowrap mb-2">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-describedby="addon-wrapping"">
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <div class="card mx-auto w-50 mt-4 bg-black">
            <div class="card-body">
                <h6 class="text-center mt-2 text-light">Tidak Punya akun? <a href="/register"><b>Buat akun!</b></a></h6>
            </div>
        </div>
    </div>
@endsection
