@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    <div class="container">
        <div class="card-body mb-5 mt-4">
            <div class="card bg-black mx-auto w-100">
            <div class="card-body">
                <form action="{{ route('postsF') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <span>
                        <div class="form-group">
                            <label for="image" class="text-light">Select Image:</label>
                            <input type="file" class="d-none" id="image" name="image">
                            <label for="image" class="card bg-black mx-auto w-100">
                                <dblogiv class="card-native">
                                    <img id="preview" src="/assets/img/11591761.jpeg" alt="">
                                </dblogiv>
                            </label>
                        </div>
                    </span>
                    <div class="form-group mt-2 flex-nowrap">
                        <input type="text" class="form-control" name="title" placeholder="Title" aria-describedby="addon-wrapping" required>
                    </div>
                    <div class="form-group mt-2 flex-nowrap">
                        <input type="text" class="form-control" name="caption" placeholder="Caption" aria-describedby="addon-wrapping" required>
                    </div>
                    <div class="form-group mt-2 flex-nowrap">
                        <textarea name='category' class="text-dark form-control" placeholder='Categoty' required></textarea>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
                </form>
            </div>
            </div>
        </div>
        <span class="mt-5">....</span>
    </div>
@endsection
@push('post')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush
@push('scriptpost')
    <script>
        var input = document.querySelector('textarea[name=category]'),
        tagify = new Tagify(input, {
        enforceWhitelist : true,
        delimiters       : null,
        whitelist        : [ "Alam", "Streamer", "permainan", "Game","Pemandangan" ,"Teknologi", "Komputer" ,"Olahraga", "Sepak Bola", "Busana", "Makanan", "Makanan Laut", "Kesehatan", "Fitness", "Transportasi", "Mobil", "Pendidikan", "Buku", "Seni", "Lukisan", "Hiburan", "Film", "Anime", "Motor", "Meme", "Stiker", "Tank", "Sepedah", "Handphone", "Setup", "Waifu", "Husbu", "Hewan", "Peliharaan", "Kota", "Desa", "Wallpaper", "Gunung", "Pantai", "Laut", "V-Tuber", "Manga", "Komik", "Manhua", "Manhwa"],
        callbacks        : {
            add    : console.log,
            remove : console.log
        }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
            readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
                $('#preview').css('display', 'block');
            }

            reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
