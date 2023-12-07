<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Saura Dental Clinic</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    
    a {
        color: #000;
    }

    .footer-text {
        font-size: 20px;
        font-family: 'Poppins'
    }

    .active1 {
        border-bottom: 2px solid #EE88B6 !important;
    }
</style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="img-fluid" style="width: 200px" src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="navHome" onclick="toggleNav('Home')" class="nav-link active1" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <div class="mx-3"></div>
                    <li class="nav-item">
                        <a id="navAbout" onclick="toggleNav('About')" class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <div class="mx-3"></div>
                    <li class="nav-item">
                        <a id="navServices" onclick="toggleNav('Services')" class="nav-link" href="{{ route('services') }}">Services</a>
                    </li>
                    <div class="mx-3"></div>
                    <li class="nav-item">
                        <a id="navContact" onclick="toggleNav('Contact')" class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                @if($user != null)
                <span class="navbar-text">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                    </ul>
                </span>
                @else
                <span class="navbar-text">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <div class="mx-2"></div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                </span>
                @endif
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    {{-- <footer id="contact" style="background-color: #92D6CB;" class=" py-5">
        <div class="container">
            <div class="row mx-auto text-center">
                <div class="col-12 p-3">
                    <img class="img-fluid" style="width: 250px" src="{{ asset('assets/images/logo.png') }}"
                        alt="logo">
                </div>
                <div class="col-12 mb-3">
                    <span class="footer-text">
                        <a href="https://www.facebook.com/people/Saura-Dental-Clinic/100090529821748/"><i
                                class='fab fa-facebook-f'></i></a>
                        <a href="https://www.instagram.com/"><i class='fab fa-instagram mx-5'></i></a>
                        <a href="https://twitter.com/"><i class='fab fa-twitter'></i></a>
                    </span>
                </div>
                <div class="col-12">
                    <span class="footer-text"><i class='fas fa-map-marker-alt'></i> Burgos St. , Poblacion Anda,
                        Pangasinan</span>
                </div>
                <div class="col-12 mb-3">
                    <span class="footer-text"><i class='fas fa-phone'></i> 09602885316</span>
                </div>

                <div class="col-12 mb-3">
                    <span class="footer-text"><a href="#">Privacy Policy</a> • <a href="#">Terms of Use</a>
                        • <a href="#">Contact Us</a></span>
                </div>
                <div class="col-12">
                    <span class="footer-text">​© {{ date('Y') }} Saura Dental Clinic. All Rights Reserved</span>
                </div>

            </div>
        </div>
    </footer> --}}
    <script>
        // JavaScript function to handle active class
        function toggleNav(navItem) {
            // Remove active class from all navigation items
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active1'));
    
            // Add active class to the clicked navigation item
            document.getElementById('nav' + navItem).classList.add('active1');
        }
    
        // jQuery function to handle active class for initial page load
        $(document).ready(function () {
            // Get the current route path
            var currentPath = window.location.pathname;
    
            // Remove active class from all navigation items
            $('.nav-link').removeClass('active1');
    
            // Add active class to the corresponding navigation item based on the current path
            if (currentPath === '/home' || currentPath === '/') {
                $('#navHome').addClass('active1');
            } else if (currentPath.includes('/about')) {
                $('#navAbout').addClass('active1');
            } else if (currentPath.includes('/services')) {
                $('#navServices').addClass('active1');
            } else if (currentPath.includes('/contact')) {
                $('#navContact').addClass('active1');
            }
        });
    </script>
    
</body>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init();
  </script>
</html>