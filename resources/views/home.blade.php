@extends('layouts.app')

@section('content')
    <header>
        <div class="container-fluid pt-5 backG">
            <div class="row-sm" style="display: flex;">
                <div class="jumbotron col-sm-7 align-self-center">
                    <h3>Hello, world!</h3>
                    <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to
                        featured content or information.</p>
                    <hr class="my-4">
                    <p>It uses utility classes for typography and spacing to space content out within the larger container.
                    </p>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </div>
            </div>
        </div>
    </header>

    {{--<div class="container-fluid py-5 bg-secondary" >--}}
    {{--    <div id="carouselId" class="carousel slide bg-dark" data-ride="carousel" style="border-radius: 5em;width: 60%;margin:auto;">--}}
    {{--        <ol class="carousel-indicators">--}}
    {{--            <li data-target="#carouselId" data-slide-to="0" class="active"></li>--}}
    {{--            <li data-target="#carouselId" data-slide-to="1"></li>--}}
    {{--            <li data-target="#carouselId" data-slide-to="2"></li>--}}
    {{--        </ol>--}}
    {{--        <div class="carousel-inner" role="listbox">--}}
    {{--            <div class="carousel-item active">--}}

    {{--                <img class="d-block mx-auto" style="height: 400px"--}}
    {{--                     src="/images/carousel/c89886e2b3cc276c4fd214eabc2b59b7.jpg" alt="First slide">--}}
    {{--            </div>--}}
    {{--            <div class="carousel-item">--}}
    {{--                <img class="d-block mx-auto" style="height: 400px" src="/images/carousel/dirt-dog.jpg"--}}
    {{--                     alt="Second slide">--}}
    {{--            </div>--}}
    {{--            <div class="carousel-item">--}}
    {{--                <img class="d-block mx-auto" style="height: 400px"--}}
    {{--                     src="/images/carousel/tumblr_ptxlmeiYsk1t7uvlqo1_1280.jpg" alt="Third slide">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev" >--}}
    {{--            <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>--}}
    {{--            <span class="sr-only" style="color:black;">Previous</span>--}}
    {{--        </a>--}}
    {{--        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next" >--}}
    {{--            <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>--}}
    {{--            <span class="sr-only" style="color: black;">Next</span>--}}
    {{--        </a>--}}
    {{--    </div>--}}
    {{--</div>--}}

    <div class="container py-5 text-center">
        <div class="row-sm">
            <div class="">
                <p class="text-dark">Dashboard</p>
            </div>

            <div class="">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <p class="text-dark"> You are logged in! </p>
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

    <footer>

        <div class="container-fluid bg-dark py-2 text-center">

            <h6 class="text-light">&copy; SKY x Saya team</h6>

        </div>
    </footer>
@endsection
