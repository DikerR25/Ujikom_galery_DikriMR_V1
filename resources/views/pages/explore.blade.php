@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    <nav class="navbar">
        <div class="container-fluid justify-content-center">
            <form class="d-flex" role="search">
                <input id="search" class="form-control me-2" type="search" placeholder="Search User" aria-label="Search User">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
        <ul id="searchResults"></ul>
    </nav>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                var searchText = $(this).val();
                if(searchText != ''){
                    $.ajax({
                        url: "{{ route('allusers') }}",
                        method: "GET",
                        data: {query: searchText},
                        success: function(data){
                            $('#searchResults').html(data);
                        }
                    });
                } else {
                    $('#searchResults').empty();
                }
            });
        });
    </script>
@endsection
