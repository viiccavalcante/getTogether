<nav class="bg-[#381841]" x-data="{ mobile_menu_open: false, profile_menu: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="{{route('user.events.index')}}" class="text-[#c598af] font-bold">GetTogether</a>

                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @foreach($menu as $title => $link)
                            <a href="{{$link}}" class="rounded-md  px-3 py-2 text-sm font-medium text-purple-200" aria-current="page">{{$title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="relative ml-3">
                        <form class="block px-4 py-2 text-sm text-white" action="{{route('logout')}}" method="post">@csrf <button>Sign out</button></form>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu" x-show="mobile_menu_open" @click.away="mobile_menu_open=false">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            @foreach($menu as $title => $link)
                <a href="{{$link}}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{$title}}</a>
            @endforeach

        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="mt-3 space-y-1 px-2">
            <form class="block px-4 py-2 text-sm text-white" action="{{route('logout')}}" method="post">@csrf <button>Sign out</button></form>
            </div>
        </div>
    </div>
</nav>
