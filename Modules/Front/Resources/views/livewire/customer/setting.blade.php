<div class="grid lg:grid-cols-3 grid-cols-1 gap-6 my-3">
    <div class="col-span-1">
        @foreach ($menus as $tab)
            <a href="javascript:void(0)" wire:click="$set('menu', '{{ $tab['menu'] }}')">
                <div class="py-3 px-4 rounded flex mb-2 {{ $tab['active'] ? 'bg-primary text-white' : 'bg-white' }}">
                    <div class="self-center pl-3 pr-4">
                        <i class="bxm {{ $tab['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="{{ $tab['active'] ? 'text-white' : 'text-slate-800' }} font-bold">
                            {{ $tab['label'] }}
                        </p>
                        <small class="text-xs font-light {{ $tab['active'] ? 'text-white/75' : 'text-slate-400' }}">
                            {{ $tab['description'] }}
                        </small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="lg:col-span-2 col-span-1 bg-white rounded" wire:loading.class="skeleton" wire:target="menu">
        <div class="p-6">
            @if ($menu == 'profile')
                <livewire:front::customer.setting.profile :customer="$customer" />
            @elseif ($menu == 'change-password')
                <livewire:front::customer.setting.change-password :customer="$customer" />
            @elseif ($menu == 'billing-information')
                <livewire:front::customer.setting.billing-information :customer="$customer" />
            @endif
        </div>
    </div>
</div>
