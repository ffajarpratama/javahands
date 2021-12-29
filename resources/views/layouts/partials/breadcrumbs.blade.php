@unless ($breadcrumbs->isEmpty())
    <nav class="px-0" style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)

                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}" style="text-decoration: none; color: #a7a7a7;">{{ $breadcrumb->title }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" style="color: black; font-weight: 500;">
                        {{ $breadcrumb->title }}
                    </li>
                @endif

            @endforeach
        </ol>
    </nav>
@endunless
