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
                <a id="navHome" class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <div class="mx-3"></div>
            <li class="nav-item">
                <a id="navAbout" onclick="toggleNav('About')" class="nav-link" href="/user/about">About</a>
            </li>
            <div class="mx-3"></div>
            <li class="nav-item">
                <a id="navServices" onclick="toggleNav('Services')" class="nav-link" href="/user/services">Services</a>
            </li>
            <div class="mx-3"></div>
            <li class="nav-item">
                <a id="navContact" onclick="toggleNav('Contact')" class="nav-link" href="/user/contact">Contact</a>
            </li>
        </ul>
        @if ($user != null)
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
<script>
    window.onload = function() {
        let currentPath = window.location.pathname;
        let aboutLink = document.getElementById('navAbout');
        let homeLink = document.getElementById('navHome');
        let contactLink = document.getElementById('navContact');
        let servicesLink = document.getElementById('navServices');

        if (currentPath.includes('/user/about')) {
            aboutLink.classList.add('active');
            homeLink.classList.remove('active');
            contactLink.classList.remove('active');
            servicesLink.classList.remove('active');
        } else if (currentPath.includes('/user/contact')) {
            contactLink.classList.add('active');
            homeLink.classList.remove('active');
            aboutLink.classList.remove('active');
            servicesLink.classList.remove('active');
        } else if (currentPath.includes('/user/services')) {
            servicesLink.classList.add('active');
            homeLink.classList.remove('active');
            aboutLink.classList.remove('active');
            contactLink.classList.remove('active');
        } else {
            // If on Home or any other page not specified above, set 'Home' as active
            homeLink.classList.add('active');
            aboutLink.classList.remove('active');
            contactLink.classList.remove('active');
            servicesLink.classList.remove('active');
        }
    };
</script>
