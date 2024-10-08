<div class="grid grid-cols-1 gap-4" x-data="{ showOrderModal: false }">
    @forelse ($items as $notif)
        <div class="grid grid-cols-1 rounded overflow-hidden {{ $notif->isSeen() ? 'bg-white' : 'bg-slate-200' }}"
             wire:loading.class="skeleton">
            <div class="nav-item p-2 relative">
                <div class="p-3 cursor-pointer" wire:click="setSeen('{{ $notif->id }}')">
                    <div class="flex -ms-1.5">
                        <div class="w-8 h-8 rounded mr-3 mt-1 relative">
                            @if (!$notif->isSeen())
                                <div class="absolute text-[8px] text-primary -top-1 -left-1">
                                    <i class="bx bxs-circle"></i>
                                </div>
                            @endif
                            <img class="w-6 h-6 max-w-6" src="{{ $notif->category->icon }}" alt="">
                        </div>
                        <div>
                            <p x-bind:class="show ? '' : 'line-clamp-2 text-ellipsis overflow-hidden'"
                               x-data="{ show: false }" x-on:mouseenter="show = !show" x-on:mouseleave="show = !show">
                                {{ $notif->title }}
                            </p>
                            <p class="text-slate-500 font-light text-sm"
                               x-bind:class="show ? '' : 'line-clamp-2 text-ellipsis overflow-hidden'"
                               x-data="{ show: false }" x-on:mouseenter="show = !show" x-on:mouseleave="show = !show">
                                {{ $notif->short_description }}
                            </p>
                            <span class="text-slate-400 text-sm font-normal">
                                <small>{{ diffForHumans($notif->created_at) }}</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <x-front::utils.404>
            Upsss... Sepertinya kamu belum memiliki notifikasi untuk saat ini.
        </x-front::utils.404>
    @endforelse

    @if ($items->hasMorePages())
        <div class="mb-5 col-span-1">
            <x-front::utils.button class="btn primary text-sm block" :loading="true" target="loadMore"
                                   wire:click="loadMore">
                Lebih banyak
            </x-front::utils.button>
        </div>
    @endif
</div>
