@if ($paginator->hasPages())
    <ul class="pager">

        <div style="max-width: 100%; width:450px" class="shadow p-3 mb-5 bg-white rounded">
            @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lsaquo;</span></li>
            @else
                <li><a wire:click="previousPage" wire:loading.attr="disabled" rel="prev">&lsaquo;</a></li>
            @endif



            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif



                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a wire:click="gotoPage({{$page}})" wire:loading.attr="disabled">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach



            @if ($paginator->hasMorePages())
                <li><a wire:click="nextPage" wire:loading.attr="disabled" rel="next">&rsaquo;</a></li>
            @else
                <li class="disabled"><span>&rsaquo;</span></li>
            @endif
        </div>
    </ul>
@endif
