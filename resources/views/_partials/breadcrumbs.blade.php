@if ($breadcrumbs)
    <ul>
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a> <span>/</span></li>
            @else
                <li ><strong>{{ $breadcrumb->title }}</strong></li>
            @endif
        @endforeach
    </ul>
@endif