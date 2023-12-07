@extends('user.layouts')
@section('content')
<style>
    .background-image {
      background-image: url('{{ asset('assets/images/opac.png') }}'), url('{{ asset('assets/images/contact.jpg') }}');
      background-repeat: no-repeat;
      background-position: center center;
      background-attachment: fixed;
      background-size: cover;
      width: 100%;
      height: 50vh; 
  }
  .title {
    font-family: 'Poppins';
    font-size: 4vw; 
    font-weight: 800;
    text-align: center;
    margin: 0;
}

.description {
    font-family: 'Poppins';
    font-size: 2vw; 
    font-weight: 200;
    max-width: 80%; 
    text-align: center;
    margin: 0;
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
        <div class="col-md-6 mx-auto">
            <span class="title">Contact US</span>
        </div>
        <div class="col-6 mx-auto d-flex flex-column align-items-center" style="border-left: 2px solid #fffcfc; padding-left: 20px;">
            <span class="description">Our top priority is providing the utmost level of healthcare. Our team excels at their work thanks to our inclusive, patient-centric atmosphere</span>
        </div>
    </div>
</div>


<div id="about" class="container mb-5 mt-5">
    <div class="row">
        <div class="col-6">
            <div class="mx-auto w-75 text-left mt-4 mb-5">
                Don't endure tooth pain; come to our dental clinic right away to address the issue. 
We are delighted to help restore your smile.
            </div>
        </div>
        <div class="col-6">
            @foreach($footers as $footer)
            <p><a  href="https://www.facebook.com/people/Saura-Dental-Clinic/100090529821748/" style="text-decoration:none" target="_blank"><i class="fa-brands fa-facebook"></i> &nbsp; {{$footer->facebook}}</a>
            </p>
            <p><i class="fa fa-phone"></i>&nbsp; {{$footer->phone}}</p>
            <p><i class="fa fa-location-dot"></i> &nbsp;Corner Pecson, Burgos street., Poblacion, <br> &nbsp;  &nbsp; Anda, Pangasinan, Anda, Philippines,<br> &nbsp;  &nbsp; 2405, Infront of Petron Gasoline Station</p>
            @endforeach
        </div>
        
     
        

        </div>
    </div>

    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Landmark%20Petron%20Street%20Burgos%20Barangay%20Poblacion%20%20Anda,%20Pangasinan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"
  ></script>
  @include('user.footer', ['footers' => $footers])
@endsection