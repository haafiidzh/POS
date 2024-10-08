<li class="nav-item relative">
    <a href="{{ route('front.cart') }}" class="nav-link !py-0 !px-1">
        <span class="h-full hover:text-primary">
            <i class="bx bx-shopping-bag !text-2xl"></i>
        </span>
    </a>
    <small class="absolute -top-1 right-0 h-4 w-4 rounded-full bg-primary text-white grid place-items-center text-[40%] leading-[1]"
           id="cart-counter">
        <span>{{ $total_items <= 100 ? $total_items : 99 }} </span>
    </small>
</li>
