<div>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            @php
                $urlSegments = Request::segments();
                $urlSegmentCount = count($urlSegments);
                $link = 'admin';
            @endphp
            <li class="breadcrumb-item">
                @if ($urlSegmentCount == 2)
                    Dashboard
                @else
                    <a href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                @endif
            </li>
            @if ($urlSegmentCount > 2)
                @for ($s = 2; $s < $urlSegmentCount; $s++)
                    @php 
                        $link = $link.".".$urlSegments[$s];
                        $isActive = $urlSegmentCount - 1 === $s;
                    @endphp
                    <li @class([ 'breadcrumb-item', 'active' => $isActive ])>
                        @if ($isActive)
                            {{ Str::ucfirst($urlSegments[$s]) }}
                        @else
                            <a href="{{ route($link) }}">{{ Str::ucfirst($urlSegments[$s]) }}</a>
                        @endif
                    </li>
                @endfor
            @endif
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4">
        <h1>{{ $pageTitle }}</h1>
        @if ($hasButton)
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="{{ $buttonUrl }}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="{{ $buttonIcon }}" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Add New Inquiry
                </a>
            </div>
        @endif
    </div>
</div>
