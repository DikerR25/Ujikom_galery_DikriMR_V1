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
            <form action="{{ route('proseslogin') }}" method="POST">
                @csrf
            <div class="form-group flex-nowrap">
                <input type="text" class="form-control" name="email" placeholder="Email" aria-describedby="addon-wrapping">
            </div>
            <div class="form-group flex-nowrap">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-describedby="addon-wrapping"">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card mx-auto w-50 mt-4">
        <div class="card-body">
            <h6 class="text-center mt-2">Tidak Punya akun? <a href="/register"><b>Buat akun!</b></a></h6>
        </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
