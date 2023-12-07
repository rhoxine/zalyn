@extends('user.layouts')
@section('content')
<style>
    .background-image {
      background-image: url('{{ asset('assets/images/opac.png') }}'), url('{{ asset('assets/images/services.png') }}');
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      height: 50vh;
  }
  .car-image{
    width: 100%;
    height: 240px;
  }
  .title1 {
            text-align:center;
            font-family: 'Poppins';
            font-size: 28px;
            margin-top: 20px

        }
        .line {
            height: 3px !important;
            border: none !important;
            background-color: #EE88B6 !important;
            width: 111px;
            margin: auto;
        }
        .ic{
            width: 100px;
            height: 70px;
        }
        .act{
            border-bottom: 2px solid #ffffff !important;
        }
        .title {
    font-family: 'Poppins';
    font-size: 2.5vw; 
    font-weight: 800;
    text-align: center;
}

.description {
    font-family: 'Poppins';
    font-size: 1.8vw; 
    font-weight: 200;
    max-width: 80%; 
    text-align: center;
}

/* Media query for smaller screens */
@media (max-width: 768px) {
    .title {
        font-size: 6vw; 
    }
    .description {
        font-size: 3vw; 
    }
}

</style>
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    @include('user.navigation')
</nav> --}}

<div class="background-image container-fluid d-flex align-items-center justify-content-center" id="first">
    <div class="row text-center" style="margin-top: 20px">
        <div class="col-12 mx-auto">
            <span class="title">Our Services</span>
        </div>
        <div class="col-12">
            <span class="description">Before we proceed with the treatment, we first assess the current <br> condition of your teeth, discuss your goals, and recommend the most suitable approach for your <br> specific dental needs</span>
        </div>
    </div>
</div>


<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Slides -->
    <h1 class="title1">DR. Saura Previous Case</h1>
    <hr class="line">

    <div class="carousel-inner">
        @foreach($gallery as $key => $galleries)
            <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                <div style="background-color: #ffffff;">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-3 mb-md-0">
                                <h3 style="color: rgb(8, 8, 8); font-family: 'Montserrat', sans-serif; font-size: 24px; padding-top: 40px;">Before</h3>
                                <img src="{{ asset('storage/' . $galleries->gallery_before) }}" alt="Before" class="car-image img-fluid">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-3 mb-md-0">
                                <h3 style="color: rgb(8, 8, 8); font-family: 'Montserrat', sans-serif; font-size: 24px; padding-top: 40px;">After</h3>
                                <img src="{{ asset('storage/' . $galleries->gallery_after) }}" alt="After" class="car-image img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controls (optional) -->
    <a class="carousel-control-prev carousel-control-custom-color" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next carousel-control-custom-color" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>


<div class="container mb-5 mt-5" style="min-height: 100vh" >
    <div class="row">
        @foreach($services as $service)
            <div class="col-lg-6 text-center" data-aos="zoom-in-up">
                <img class="w-25 img-fluid" src="{{ asset('storage/' . $service->services_image) }}" alt="{{ $service->services_name }}">
                <h1 class="title1">{{ $service->services_name }}</h1>
                <div class="mx-auto w-75 text-left mt-4 mb-5">
                    {{ $service->desc }}
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    // Enable carousel auto-cycling
    $('#myCarousel').carousel({
        interval: 3000, // Adjust the interval (in milliseconds) as needed
        pause: 'hover',
        wrap: true
    });
</script>
@include('user.footer', ['footers' => $footers])
@endsection