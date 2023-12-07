@extends('user.layouts')
@section('content')
    <style>
        .background-image {
            background-image: url('{{ asset('assets/images/opac.png') }}'), url('{{ asset('assets/images/about-bg.jpg') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
            width: 100%;
            height: 50vh;
        }

        .title1 {

            font-family: 'Poppins';
            font-size: 33px;
            

        }

        .title {
            font-family: 'Poppins';
            font-size: 2.5vw;
            font-weight: 800;
            min-font-size: 24px;
            
        }

        .description {
            font-family: 'Poppins';
            font-size: 1.8vw;
            font-weight: 200;
            max-width: 80%;
        }

        .btn-appointment {
            background-color: #EE88B6;
            border-radius: 20px;
            font-size: 1.3vw;
            font-family: 'Fahkwang';
            width: 40%;
            max-width: 321px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .title {
                font-size: 5vw;
            }

            .description {
                font-size: 4vw;
            }

            .btn-appointment {
                font-size: 3vw;
            }
        }


        .box-1,
        .box-2 {
            background: rgb(219, 189, 194);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            height: 250px;
        }
    </style>

    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        @include('user.navigation')
    </nav> --}}
    <div class="background-image container-fluid d-flex align-items-center justify-content-center" id="first">
        <div class="row text-center" style="margin-top: 20px">
            <div class="col-12 mx-auto">
                <span class="title">About Dental Clinic</span>
            </div>

            <div class="col-12">
                <span class="description">Our top priority is providing the utmost level of healthcare. <br> Our team excels
                    at their work thanks to our inclusive, patient-centric atmosphere</span>
            </div>
            <div class="col-12 my-3">
                <a href="{{ route('login') }}" class="btn btn-appointment">Appointment Now!</a>
            </div>
        </div>
    </div>

    <div id="about" class="container mb-5 mt-5">
        <div class="row">
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <h1 class="title1 text-left">Saura Dental Clinic</h1>
                <div class="mx-auto w-75 text-left mt-4 mb-5">
                    SDC wants to assist people who don't have a sufficient budget to visit a dental clinic for check-ups because it can be expensive. Saura offers budget-friendly yet high-quality services. Andanians will no longer need to worry about the cost when they visit a dental clinic. Your smile matters; come and visit us.
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center" data-aos="fade-left">
                <img class="img-fluid" src="{{ asset('assets/images/saura.jpg') }}" style="width:100%; max-height: 250px;">
            </div>
        </div>
    </div>
    

    <div class="container mb-5 mt-5">
        <div class="row" style="margin-left: 60px">
            <div class="col-md-4 d-flex align-items-center justify-content-center" data-aos="fade-right">
                <img class="img-fluid "  src="{{ asset('assets/images/dra.jpg') }}"
                    style="width:100%; max-height: 250px; padding-left:20px; padding-right:20px;">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <h1 class="title1 text-left" style="margin-top: 20px; ">Dr. Lovely Mae Q. Saura</h1>
                <div class="mx-auto w-75 text-left mt-2 mb-2">
                    <p class="text-muted">The founder of SDC</p>
                    <p style="margin-top: 0; margin-bottom: 0;">We prioritize excellence in every aspect of our dental services, ensuring that each procedure and treatment meets the highest standards of quality.</p>
                    <p style="margin-top: 0; margin-bottom: 0;">We help you to bring back your lovely smile to gain your confidence again</p>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container">
        @foreach($footers as $footer)
        <div class="row justify-content-center">
            
            <div class="col-lg-4 col-md-4 col-sm-4" data-aos="zoom-in-right">
                <div class="box-1 shadow">
                    <span style="font-family: 'Poppins'; font-size: 24px; font-weight:200">Address</span>
                    <div class="mx-auto w-75 text-left mt-2">
                        {{ $footer->address }}
                    </div> <br>
                    <div class="mx-auto w-75 text-left mt-2">
                        {{ $footer->phone }}
                    </div>
                </div>
            </div>
    
            <div class="col-lg-4 col-md-4 col-sm-4" data-aos="zoom-in-left">
                <div class="box-1 shadow">
                    <span style="font-family: 'Poppins'; font-size: 24px; font-weight:200">Hours</span>
                    <div class="mx-auto w-75 text-left mt-2">
                        Open from <br>
                        {{ $footer->days}} <br> <br>
    
                        {{ $footer->hours}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @include('user.footer', ['footers' => $footers])
   
@endsection
