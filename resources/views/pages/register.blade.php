@extends('layouts.main-auth')

@section('kontent')
  <div class="container">
    <div class="card mx-auto w-50 mt-5 bg-black">
        <h2 class="card-title text-center mt-4 text-light">Galery Foto</h2>
      <div class="card-body">
        <div class="card mx-auto w-100 bg-dark">
          <div class="card-body">
            <form action="/proses-register" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group mt-2">
                    <input type="text" class="form-control" name="full_name" placeholder="Full Name">
                </div>
                <div class="form-group mt-2">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group mt-2">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group mt-2">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card mx-auto w-50 mt-4 bg-black">
        <div class="card-body">
            <h6 class="text-center mt-2 text-light">Sudah Punya akun?, <a href="/login"><b>Masuk!</b></a></h6>
        </div>
      </div>
  </div>
@endsection
