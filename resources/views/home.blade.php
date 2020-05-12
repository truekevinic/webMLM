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
{{--saya menggangap org uplod advert hrs sesuai dengan ukuran yang di tentukan--}}
@if(count($advertisements) > 0)
<div class="slideshow-containerslide p-5 container-decorate my-2">
    @foreach($advertisements as $ad)
    <div class="mySlidesslide fadeslide">
        <img src="{{asset("storage/images/$ad->image_source")}}" style="width:100%;height:400px; ">
        <div>
            <h3>LINK: {{$ad->link}}</h3>
        </div>
        <div>
            <h3>DESCRIPTION: {{$ad->description}}</h3>
        </div>
    </div>
    @endforeach
    <div style="text-align:center">
        @for ($i = 1; $i <= count($advertisements); $i++) <span class="dotslide" onclick="currentSlide({{$i}})"></span>
            @endfor
    </div>
</div>
<br>


{{-- <div class="container-fluid py-5 bg-secondary" >
        <div id="carouselId" class="carousel slide bg-dark" data-ride="carousel" style="border-radius: 5em;width: 60%;margin:auto;">

            <div class="carousel-inner" role="listbox">
                @foreach($advertisements as $ad)
                    <div class="carousel-item active">
                        <img class="d-block mx-auto" style="height: 400px"
                             src="{{asset("storage/images/$ad->image_source")}}" alt="First slide">


</div>
@endforeach
</div>
<a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black;"></span>
    <span class="sr-only" style="color:black;">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true" style="color: black;"></span>
    <span class="sr-only" style="color: black;">Next</span>
</a>
</div>
</div> --}}
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
        @for ($i = 0; $i < 3; $i++) 
        <div class="card  animate">
            <div class="card-body text-center">
                <i class="fas fa-user display-2"></i>
                <h5 class="card-title ">Card title</h5>

                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis fuga quaerat
                    eligendi eius quidem dicta cumque a id illum laborum neque voluptate quo earum reiciendis, similique
                    vero asperiores eum animi!</p>
            </div>
        </div>
        @endfor
    </div>
</div>
<script>
    var slideIndex = 0;
        showSlides();
        
        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("mySlidesslide");
          var dots = document.getElementsByClassName("dotslide");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" activeslide", "");
          }
          for(i=0; i< 10000;i++);
          slides[slideIndex-1].style.display = "block";  
        //   if(slideIndex-2 < 0){
        //     slides[slideIndex-1].style.display = "block";
        //     slides[slideIndex-1].style.width = "block";
        //   }
          dots[slideIndex-1].className += " activeslide";
          setTimeout(showSlides, 4000); // Change image every 2 seconds
          
        }
</script>
@endsection