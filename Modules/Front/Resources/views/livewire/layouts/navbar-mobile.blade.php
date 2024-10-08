<div id="mobileMenu"
     class="fc-offcanvas-open:translate-x-0 translate-x-full fixed top-0 end-0 transition-all duration-200 transform h-full w-full max-w-md z-50 bg-white border-s hidden">
    <div class="flex flex-col h-full divide-y-2 divide-gray-200">
        <div class="p-6 flex items-center justify-between">
            <a href="{{ route('front.index') }}">
                <img src="{{ cache('logo') }}" class="h-8" alt="Logo">
            </a>

            <button data-fc-dismiss class="flex items-center px-2">
                <i class="bx bx-x text-4xl"></i>
            </button>
        </div>

        <!-- Mobile Menu Link List -->
        <div class="p-6 overflow-scroll h-full">
            <ul class="navbar-nav flex flex-col gap-2" data-fc-type="accordion">
                @foreach ($menus as $item)
                    @if (empty($item['childs']))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="javascript:void(0)" data-fc-type="collapse" class="nav-link">
                                {{ $item['name'] }}
                                <i
                                   class="bx bx-chevron-down ml-auto align-middle transition-all fc-collapse-open:rotate-180"></i>
                            </a>

                            <ul class="hidden overflow-hidden transition-[height] duration-300 space-y-2">
                                @foreach ($item['childs'] as $child)
                                    @if ($child['name'] == 'divider')
                                    @else
                                        <li class="nav-item mt-2">
                                            <a class="nav-link ml-2"
                                               href="{{ $child['link'] }}">{{ $child['name'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        @if (!$loggedIn)
            <div class="p-6 flex items-center justify-center">
                <a href="{{ route('customer.login.form', ['next' => request()->path()]) }}"
                   class="btn primary mr-2 text-sm flex-1">
                    Masuk
                </a>
                <a href="{{ route('customer.register.form') }}" class="btn outline-primary text-sm flex-1">
                    Daftar
                </a>
            </div>
        @endif
    </div>
</div>
