@extends('layouts.main-auth')

@section('kontent')
    <div class="container">
        <div class="card mx-auto w-50 mt-5 bg-black card-shadow-native">
            <h2 class="card-title text-center mt-4 text-light">Galery Foto</h2>
        <div class="card-body">
            <div class="card mx-auto w-100 bg-dark card-shadow-native">
                <div class="card-body">
                    <form action="{{ route('proseslogin') }}" method="POST">
                        @csrf
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-group flex-nowrap mb-2">
                            <input type="email" class="form-control" name="email" placeholder="Email" aria-describedby="addon-wrapping" required>
                        </div>
                        <div class="form-group flex-nowrap mb-2">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-describedby="addon-wrapping" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <div class="card mx-auto w-50 mt-4 bg-black card-shadow-native">
            <div class="card-body">
                <h6 class="text-center mt-2 text-light">Tidak Punya akun? <a href="/register"><b>Buat akun!</b></a></h6>
            </div>
        </div>
    </div>
@endsection
