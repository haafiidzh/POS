 <div class="grid md:grid-cols-3 gap-6 mb-6">

     {{-- Order --}}
     <div class="col-span-1">
         <div class="card">
             <div class="p-6">
                 <div class="flex items-center" wire:loading.class="skeleton" wire:target.except="customer_status">
                     <div class="flex-shrink-0 me-3">
                         @switch($order_status)
                             @case('pending')
                                 <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                                     <i class="bx bx-file text-xl"></i>
                                 </div>
                             @break

                             @case('complete')
                                 <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                                     <i class="bx bx-file text-xl"></i>
                                 </div>
                             @break

                             @case('expired')
                                 <div class="w-12 h-12 flex justify-center items-center rounded text-danger bg-danger/25">
                                     <i class="bx bx-file text-xl"></i>
                                 </div>
                             @break
                         @endswitch
                     </div>
                     <div class="flex-grow">
                         <h5 class="mb-1">
                             <a href="{{ route('administrator.order.index', ['tab' => $order_status]) }}">
                                 Pesanan
                             </a>
                         </h5>
                         {{-- <p class="text-slate-500">{{ $count['order'] }} {{ $switch['order'] }}</p> --}}
                     </div>
                     <div>
                         <x-administrator::alpine-dropdown>
                             <i class="text-lg bx bx-dots-vertical-rounded"></i>
                             <x-slot name="list">
                                 <div class="px-2 py-3">
                                     @foreach ($statuses['order'] as $status)
                                         <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 hover:bg-gray-100 {{ $order_status == $status['value'] ? 'bg-gray-100' : 'bg-transparent' }}"
                                            href="javascript:void(0)" x-on:click="toggle()"
                                            wire:click="$set('order_status', '{{ $status['value'] }}')">
                                             {{ $status['label'] }}
                                         </a>
                                     @endforeach
                                 </div>
                             </x-slot>
                         </x-administrator::alpine-dropdown>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="col-span-1">
         <div class="card">
             <div class="p-6">
                 <div class="flex items-center" wire:loading.class="skeleton" wire:target.except="order_status">
                     <div class="flex-shrink-0 me-3">
                         <div class="w-12 h-12 flex justify-center items-center rounded text-primary bg-primary/25">
                             <i class="bx bx-user text-xl"></i>
                         </div>
                     </div>
                     <div class="flex-grow">
                         <h5 class="mb-1">
                             <a href="{{ route('administrator.customer.index', ['tab' => $customer_status]) }}">
                                 Pelanggan
                             </a>
                         </h5>
                         {{-- <p class="text-slate-500">{{ $count['customer'] }}
                             {{ $switch['customer'] != 'Semua' ? $switch['customer'] : '' }}</p> --}}
                     </div>
                     <div>
                         <x-administrator::alpine-dropdown>
                             <i class="text-lg bx bx-dots-vertical-rounded"></i>
                             <x-slot name="list">
                                 <div class="px-2 py-3">
                                     @foreach ($statuses['customer'] as $status)
                                         <a class="flex items-center gap-1.5 py-1.5 px-3.5 rounded text-sm transition-all duration-300 hover:bg-gray-100 {{ $customer_status == $status['value'] ? 'bg-gray-100' : 'bg-transparent' }}"
                                            href="javascript:void(0)" x-on:click="toggle()"
                                            wire:click="$set('customer_status', '{{ $status['value'] }}')">
                                             {{ $status['label'] }}
                                         </a>
                                     @endforeach
                                 </div>
                             </x-slot>
                         </x-administrator::alpine-dropdown>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="col-span-1">
         <div class="card">
             <div class="p-6">
                 <div class="flex items-center" wire:loading.class="skeleton"
                      wire:target.except="customer_status, order_status">
                     <div class="flex-shrink-0 me-3">
                         <div class="w-12 h-12 flex justify-center items-center rounded text-warning bg-warning/25">
                             <i class="bx bx-message-dots text-xl"></i>
                         </div>
                     </div>
                     <div class="flex-grow">
                         <h5 class="mb-1">
                             <a href="javascript:void(0)">
                                 Pesan Publik
                             </a>
                         </h5>
                         <p class="text-slate-500">{{ $count['guest_message'] }} Belum terbaca</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
