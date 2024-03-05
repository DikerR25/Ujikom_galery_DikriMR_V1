@extends('layouts.main')
@section('kontent')
    @include('partials.navbar-bottom')
    <div class="wrapper-native">
        <div class="container-native">
            @for ($i = 0; $i < 15; $i++)
                <div class="box-native">
                    <div class="body-img-native">
                        <a href="/img/1">
                            <img src="https://i.pinimg.com/originals/b2/af/01/b2af01d1fdfd349f949ec3308fc4270c.jpg" alt="">
                            <div class="creator-native">Dikri Mahali Ramdai</div>
                            <span class="comment-native text-center row"><i class="fa-solid fa-comment fs-1"></i><span>100</span></span>
                            <span class="like-native text-center row"><i class="fa-solid fa-heart fs-1"></i><span>100</span></span>
                        </a>
                    </div>
                </div>
                <div class="box-native">
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="https://i.pinimg.com/236x/ee/c9/28/eec9283201e20a8b046b42792472a02e.jpg" alt="">
                    </a>
                </div>
                <div class="box-native">
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="https://i.pinimg.com/236x/3a/00/2d/3a002db8afce64e58c9cdf7393f4a724.jpg" alt="">
                    </a>
                </div>
                <div class="box-native">
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="https://i.pinimg.com/236x/94/60/c8/9460c83d30dd184542a622b13751ee13.jpg" alt="">
                    </a>
                </div>
            @endfor
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="https://i.pinimg.com/236x/22/c0/91/22c091b46f50a29446b38ff284bc6e0c.jpg" alt="">
                </div>
            </div>
            </div>
        </div>


@endsection
