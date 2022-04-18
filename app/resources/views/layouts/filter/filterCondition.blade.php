<p class="text-center m-2">
    @if(!empty($validatedRequest['search']))
        {!!$validatedRequest['search']['from']===$validatedRequest['search']['to']?
            "Результат за <strong>" . $validatedRequest['search']['from']. "</strong>":
            "Результат с <strong>" . $validatedRequest['search']['from'] . "</strong> по <strong>" . $validatedRequest['search']['to'] . "</strong>"!!}
    @else
        @yield('default')
    @endif
</p>

