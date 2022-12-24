@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" style="border-radius: 30px; background-color: #F0F0F0;" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"><img src="{{asset('assets/site/images/vector-right.png')}}" class="arrow_icon"></span>
                </li>
            @else
                <li style="border-radius: 30px; background-color: #F0F0F0;">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><img src="{{asset('assets/site/images/vector-right.png')}}" class="arrow_icon"></a>
                </li>
            @endif

            <div class="numbers">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li style="padding: 10px 10px ;border-radius: 5px" class="active-page" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li style="padding: 10px 10px ;border-radius: 5px"><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            </div>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li style="border-radius: 30px; background-color: #F0F0F0;" >
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><img src="{{asset('assets/site/images/vector-left.png')}}" class="arrow_icon"></a>
                </li>
            @else
                <li class="disabled" style="border-radius: 30px; background-color: #F0F0F0;"  aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true"><img src="{{asset('assets/site/images/vector-left.png')}}" class="arrow_icon"></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
