@extends('layouts.app')

@section('content')
    <header>
        <div class="container-fluid pt-5 backG">
            <div class="row-sm" style="display: flex;">
                <div class="jumbotron col-sm-7 align-self-center my-auto">

                </div>
            </div>
        </div>
    </header>
    @if(count($advertisements) > 0)
    <div class="container-fluid py-5 bg-secondary" >
        <div id="carouselId" class="carousel slide bg-dark" data-ride="carousel" style="border-radius: 5em;width: 60%;margin:auto;">

            <div class="carousel-inner" role="listbox">
                @foreach($advertisements as $ad)
                    <div class="carousel-item active">
                        <img class="d-block mx-auto" style="height: 400px"
                             src="{{asset("storage/images/$ad->image_source")}}" alt="First slide">
                        <p>LINK: {{$ad->link}}</p>
                        <p>DESCRIPTION: {{$ad->description}}</p>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev" >
                <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>
                <span class="sr-only" style="color:black;">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next" >
                <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>
                <span class="sr-only" style="color: black;">Next</span>
            </a>
        </div>
    </div>
    @endif

    <div class="parallax"></div>

    <div class="container py-5 text-center">
        <div class="row-sm">
            <div class="">
                <p class="text-dark">Donasi yang telah terkumpul</p>
            </div>

            <div class="">
                <p class="text-dark">${{$donation}}</p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 backGNoImage">
        <div class="card-deck ">
            <div class="card  ">
                <div class="row">
                    {{--                <div class="col-sm">--}}
                    {{--                    <img class="card-img-top" src="..." alt="Card image cap">--}}
                    {{--                </div>--}}
                    <div class="col-sm">
                        <h5 class="card-title text-center" >Card title</h5>
                    </div>
                </div>
                <div class="card-body">

                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis fuga quaerat
                        eligendi eius quidem dicta cumque a id illum laborum neque voluptate quo earum reiciendis, similique
                        vero asperiores eum animi!</p>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    {{--                <div class="col-sm">--}}
                    {{--                    <img class="card-img-top" src="..." alt="Card image cap">--}}
                    {{--                </div>--}}
                    <div class="col-sm">
                        <h5 class="card-title text-center">Card title</h5>
                    </div>
                </div>
                <div class="card-body">

                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis maiores
                        libero perferendis mollitia at accusantium, ipsa laboriosam eius sed minima velit quas doloribus
                        temporibus pariatur repellat delectus nam saepe aliquid. This card has supporting text below as a
                        natural lead-in to additional content.</p>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    {{--                <div class="col-sm">--}}
                    {{--                    <img class="card-img-top" src="..." alt="Card image cap">--}}
                    {{--                </div>--}}
                    <div class="col-sm">
                        <h5 class="card-title text-center">Card title</h5>
                    </div>
                </div>
                <div class="card-body">

                    <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Excepturi adipisci
                        repellat quas iste est natus ad autem, impedit error dolorum? In, minus ea aliquam quae voluptas
                        optio alias quod expedita? This is a wider card with supporting text below as a natural lead-in to
                        additional content. This card has even longer content than the first to show that equal height
                        action.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
