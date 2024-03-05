<!DOCTYPE html>
<html>
<head>
  <title>{{ $title }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="card mx-auto w-50 mt-5">
        <h2 class="card-title text-center mt-4">Galery Foto</h2>
      <div class="card-body">
        <div class="card mx-auto w-100">
          <div class="card-body">
            <form action="/proses-register" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="full_name" placeholder="Full Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card mx-auto w-50 mt-4">
        <div class="card-body">
            <h6 class="text-center mt-2">Sudah Punya akun?, <a href="/register"><b>Masuk!</b></a></h6>
        </div>
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
