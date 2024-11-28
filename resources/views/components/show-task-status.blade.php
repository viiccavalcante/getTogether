<span class="text-sm font-medium 
    @switch($status)
        @case('Assigned')
            text-[#8e4b71]
            @break
        @case('Done')
            text-green-500
            @break
        @default
            text-gray-500
    @endswitch
">
    {{ $status }}
</span>