<footer id="contact" style="background-color: #92D6CB;" class="py-5">
    <div class="container">
        <div class="row mx-auto text-center">
            @foreach ($footers as $singleFooter)
                <div class="col-12 p-3">
                    @if ($singleFooter->logo)
                        <img class="img-fluid" style="width: 230px" src="{{ asset('storage/' . $singleFooter->logo) }}"
                            alt="logo">
                    @else
                        <img class="img-fluid" style="width: 250px" src="{{ asset('assets/images/default-logo.png') }}"
                            alt="default logo">
                    @endif
                </div>

                <div class="col-12 mb-2">
                    <span class="footer-text">
                        <a href="https://www.facebook.com/people/Saura-Dental-Clinic/100090529821748/"
                            style="text-decoration:none" target="_blank">
                            <i class="fa-brands fa-facebook"></i> &nbsp;{{ $singleFooter->facebook }}
                        </a>
                    </span>
                </div>
                <div class="col-12 mb-2">
                    <span class="footer-text"><i class='fas fa-map-marker-alt'></i> {{ $singleFooter->address }}</span>
                </div>
                <div class="col-12 mb-2">
                    <span style="margin-right: 50px"class="footer-text"><i class='fas fa-phone'></i>
                        {{ $singleFooter->phone }}</span>
                </div>
                {{-- <div class="col-12 mb-3">
                    <span class="footer-text"><a href="#">Privacy Policy</a> • <a href="#">Terms of Use</a>
                        • <a href="#">Contact Us</a></span>
                </div> --}}
                <div class="col-12">
                    <span class="footer-text">​© {{ date('Y') }} {{ $singleFooter->copyright }}</span>
                </div>
            @endforeach
        </div>
    </div>
</footer>
