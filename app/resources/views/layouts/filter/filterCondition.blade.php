<p class="text-center m-2">
    @if(!empty($filterCondition))
        @if(is_array($filterCondition))
            Результаты с {{$filterCondition['from']. ' по ' . $filterCondition['to']}}
        @else
            @switch($filterCondition)
                @case('today')
                    Результаты за текущий день.
                @break
                @case('yesterday')
                    Результаты за вчерашний день.
                @break
                @case('week')
                    Результаты за неделю.
                @break
            @endswitch
        @endif
    @else
        @yield('default')
    @endif
</p>

