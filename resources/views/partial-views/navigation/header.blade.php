<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="height: 90px;background:#000000;">
        <div class="container-fluid mx-2 px-3">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('dist/images/logo-brown-bg-sm.svg') }}" alt="" style="height: 72px;width:auto;">
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link " aria-current="page" href="{{ route('home') }}">Accomadation</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Packages & Rates</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Offers</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Gallery</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" aria-current="page" href="{{ route('guest.blogs') }}">Journal</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link" aria-current="page" href="{{ route('guest.blogs') }}">Contact Us</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="{{ route('guest.inquiries.request') }}" class="btn bg--baige text-white px-3 py-2">
                            Check Availabiity
                        </a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
    </nav>
</header>
