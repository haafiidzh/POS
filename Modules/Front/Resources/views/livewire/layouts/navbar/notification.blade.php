<li class="nav-item relative">
    {{-- <a href="javascript:void(0);" class="nav-link after:absolute hover:after:-bottom-10 after:inset-0 fc-dropdown"
       data-fc-type="dropdown" data-fc-target="landingDropdownMenu" data-fc-placement="bottom">
        <span class="h-full hover:text-primary">
        </span>
    </a> --}}
    <a href="javascript:void(0)"
       class="nav-link !py-0 !px-1 after:absolute hover:after:-bottom-10 after:inset-0 fc-dropdown"
       data-fc-type="dropdown" data-fc-target="landingDropdownMenu" data-fc-placement="bottom">
        <span class="h-full hover:text-primary">
            <i class="bx bx-bell !text-2xl"></i>
        </span>
    </a>
    <small class="absolute -top-1 right-0 h-4 w-4 rounded-full bg-primary text-white grid place-items-center text-[40%] leading-[1]"
           id="notification-counter">
        <span>{{ $count < 100 ? $count : '99+' }} </span>
    </small>

    <div id="landingDropdownMenu"
         class="hidden opacity-0 mt-4 fc-dropdown-open:opacity-100 fc-dropdown-open:translate-y-0 translate-y-3 origin-center transition-all bg-white rounded-lg shadow-lg border w-auto fc-dropdown-open:flex flex-col fc-dropdown">
        <div class="max-h-[300px] w-[250px] overflow-auto rounded-t-lg">
            @foreach ($notifications as $notif)
                <div class="nav-item p-2 relative">
                    <div class="text-slate-600 hover:text-slate-800 p-3 cursor-pointer"
                         wire:click="setSeen('{{ $notif->id }}')">
                        <div class="flex -ms-1.5">
                            <div class="w-8 h-8 rounded mr-3 mt-1 relative">
                                @if (!$notif->isSeen())
                                    <div class="absolute text-[8px] text-primary -top-1 -left-1">
                                        <i class="bx bxs-circle"></i>
                                    </div>
                                @endif
                                <img class="w-6 h-6 max-w-6" src="{{ optional($notif->category)->icon }}"
                                     alt="">
                            </div>
                            <div class="">
                                <p class="text-xs/4 font-normal"
                                   x-bind:class="show ? '' : 'line-clamp-2 text-ellipsis overflow-hidden'"
                                   x-data="{ show: false }" x-on:mouseenter="show = !show"
                                   x-on:mouseleave="show = !show">
                                    {{ $notif->short_description }}
                                </p>
                                <span class="text-gray-400 text-xs font-normal">
                                    <small>{{ diffForHumans($notif->created_at) }}</small>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-t">
            @endforeach
        </div>
        <a href="{{ route('customer.notification') }}"
           class="w-full bg-slate-100 inline-flex items-center justify-center text-sm text-gray-800 py-4 px-3">
            Selengkapnya
        </a>
    </div>
</li>
