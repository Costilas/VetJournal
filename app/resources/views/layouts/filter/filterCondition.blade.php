<p class="text-center m-2">
    @if(!empty($validatedRequest['search']))
        {!!$validatedRequest['search']['from']===$validatedRequest['search']['to']?
            "Результат за <strong>" . \Carbon\Carbon::create($validatedRequest['search']['from'])->format('d-m-Y'). "</strong>":
            "Результат с <strong>" . \Carbon\Carbon::create($validatedRequest['search']['from'])->format('d-m-Y') .
            "</strong> по <strong>" . \Carbon\Carbon::create($validatedRequest['search']['to'])->format('d-m-Y') . "</strong>"!!}
    @else
        @yield('default')
    @endif
</p>
