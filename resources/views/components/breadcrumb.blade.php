<div>
    @php
        $urlSegments = Request::segments();
        $urlSegmentCount = count($urlSegments);
        $link = 'admin';
    @endphp

    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3 fw-bold">
                @if ($urlSegmentCount > 2)
                    @for ($s = 2; $s < $urlSegmentCount; $s++)
                        @php 
                            $link = $link.".".$urlSegments[$s];
                            $isActive = $urlSegmentCount - 1 === $s;
                        @endphp
                            @if ($isActive)
                                {{ Str::ucfirst($urlSegments[$s]) }}
                            @else
                                <a href="{{ route($link) }}" class="text-decoration-none"> {{ Str::ucfirst($urlSegments[$s]) }} </a>
                                <span class="fs-5">/</span>
                            @endif
                    @endfor
                @endif
            </h1>
        </div>
    </div>
</div>
