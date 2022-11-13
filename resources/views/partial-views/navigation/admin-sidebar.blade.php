{{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-5">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door-fill"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.inquiries') }}">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    Inquiries
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reservations') }}">
                    <i class="bi bi-bookmarks-fill"></i>
                    Reservations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.blogs') }}">
                    <i class="bi bi-file-post"></i>
                    Blog Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-bar-chart-fill"></i>
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.roles') }}">
                    <i class="bi bi-bar-chart-fill"></i>
                    Roles
                </a>
            </li>
        </ul> --}}

        {{-- <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Current month
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Last quarter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Social engagement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Year-end sale
                </a>
            </li>
        </ul> --}}
    {{-- </div>
</nav> --}}

<div class="d-flex flex-column align-items-center px-3 py-5 w-18" style="background-color: rgb(26, 82, 118)">
    <div class="mb-4 w-50">
        <a class="nav-link text--light-blue" aria-current="page" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house-door-fill pe-2"></i>
            Dashboard
        </a>
    </div>
    <div class="mb-4 w-50">
        <a class="nav-link text--light-blue" href="{{ route('admin.inquiries') }}">
            <i class="bi bi-layout-text-window-reverse pe-2"></i>
            Inquiries
        </a>
    </div>
    <div class="mb-4 w-50">
        <a class="nav-link text--light-blue" href="{{ route('admin.reservations') }}">
            <i class="bi bi-bookmarks-fill pe-2"></i>
            Reservations
        </a>
    </div>
    <div class="mb-4 w-50">
        <a class="nav-link text--light-blue" href="{{ route('admin.blogs') }}">
            <i class="bi bi-file-post pe-2"></i>
            Blog Posts
        </a>
    </div>
    <div class="mb-4 w-50">
        <a class="nav-link text--light-blue" href="#">
            <i class="bi bi-bar-chart-fill pe-2"></i>
            Reports
        </a>
    </div>
    <div class="mb-4 w-50">
        <a class="nav-link text--light-blue" href="{{ route('admin.roles') }}">
            <i class="bi bi-bar-chart-fill pe-2"></i>
            Roles
        </a>
    </div>
</div>
