@extends('user.layouts')
@section('content')
    <style>

        .background-image {
            background-image: url('{{ asset('assets/images/opac.png') }}'), url('{{ asset('assets/images/bg-workplace.png') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            width: 100%;
        }

        .title {
            text-align: center;
            font-family: 'Poppins';
            font-size: 48;

        }

        .line {
            height: 3px !important;
            border: none !important;
            background-color: #EE88B6 !important;
            width: 111px;
            margin: auto;
        }

        .container {
            scroll-margin-top: 120px;
        }
    </style>


    <div class="background-image container-fluid vh-100 d-flex align-items-center justify-content-center" id="first">
        <div class="row text-center" style="margin-top: -150px">
            <div class="col-12 mx-auto">
                <span style="font-family: 'Poppins'; font-size: 40px; ">Need a Dentist?</span>
            </div>
            <div class="col-12">
                <span style="font-family: 'Poppins'; font-size: 52px; font-weight:800">Visit Saura Dental Clinic Now!</span>
            </div>
            <div class="col-12">
                <span style="font-family: 'Poppins'; font-size: 24px; font-weight:200">Love your teeth, Love your
                    smile</span>
            </div>
            <div class="col-12 my-3">
                <a href="{{ route('login') }}" class="btn"
                    style="background-color: #EE88B6; border-radius: 20px; width: 321px; font-size: 20px; font-family: 'Fahkwang'">Appointment
                    Now!</a>
            </div>
        </div>
    </div>
    <div id="about" class="container mb-5 mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Experience Elevated</h1>
                <hr class="line">
                <div class="mx-auto w-75 text-center mt-4 mb-5">
                    SDC is a collection of scientifically based principles focused on elevating a patient’s dental
                    experience.
                    Its goal is to increase a patient’s awareness of oral preventive care by creating an environment
                    unlike
                    no
                    other and offering the highest standards of service.
                </div>
            </div>
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 mt-3" data-aos="fade-up"
                        data-aos-anchor-placement="bottom-bottom">
                            <img class="img-fluid w-100" src="{{ asset('assets/images/equip2.png') }}" alt="Image">
                        </div>
                        <div class="col-sm-4 mt-3" data-aos="fade-down"
                        data-aos-easing="linear"
                        data-aos-duration="1500">
                            <img class="img-fluid w-100" src="{{ asset('assets/images/workplace.png') }}" alt="Image">
                        </div>
                        <div class="col-sm-4 mt-3" data-aos="fade-up"
                        data-aos-anchor-placement="top-center">
                            <img class="img-fluid w-100" src="{{ asset('assets\images\radiograph.png') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="services" class="container my-5 mt-5">
        <div class="row">
            <div class="col-12">
                @isset($services)
                    @if(count($services) > 0)
                        <h1 class="title">Services</h1>
                        <hr class="line">
                        <div class="container my-5">
                            <div class="row">
                                @foreach ($services as $service)
                                    <div class="col-sm-6 col-lg-4 mt-4 text-center">
                                        <img class="w-25 img-fluid" src="{{ asset('storage/' . $service->services_image) }}" alt="{{ $service->services_name }}">
                                        <br>
                                        <span>{{ $service->services_name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endisset
            </div>
        </div>
    </div>
    
    {{-- <div class="container">
        @isset($reviews)
            @if(count($reviews) > 0)
                <h1 class="title">Reviews</h1>
    
                <!-- Display Reviews -->
                <div class="row">
                    @foreach($reviews as $review)
                        <div class="col-md-4 mb-3">
                            <div class="card" style="width: 300px;">
                                <div class="card-body text-center">
                                    <h4>{{ $review->user->name }}</h4>
                                    <small class="text-muted">{{ $review->created_at->format('F j, Y') }}</small>
                                    <br>
                                    {{-- <span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->rating ? ' active' : '' }}"
                                               style="color: {{ $i <= $review->rating ? '#f90' : '#000' }}"></i>
                                        @endfor
                                    </span> <br> --}}
                                    {{-- <span>{{ $review->comment }}</span>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endisset
    </div>  --}}
    
    
    @include('user.footer', ['footers' => $footers])
@endsection