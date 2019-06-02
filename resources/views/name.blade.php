@extends('layouts.app')

@section('content')

    <p class="product"><a href="#"><img src="http://placehold.it/64/64" alt=""/>test 1</a>


    </p>

    <script>
    $(document).ready(function () {
        $(".product a").mouseover(function () {
            $(".product a img").css("display", "none"); // hide all product images
            $(this).find("img").css("display", "inline-block"); // show current hover image
        })
        $(".product a").mouseout(function () {
            $(".product a img").css("display", "none"); // hide all product images
        })
    });
    </script>

    <style>
    p.product a img {
        display: none;
        position: absolute;
        left: -80px;
        top: -22px;
    }
    p.product a {
        display: inline-block;
        position: relative;
    }
    p.product {
        margin-left: 100px;
    }
    </style>






@endsection
