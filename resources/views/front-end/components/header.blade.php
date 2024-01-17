{{-- header --}}
<header class="py-4 shadow-sm bg-white">
    <div class="container flex items-center justify-between">
    <a href="{{route('client.home')}}">
        <img src="{{ asset('img/front_end/logo.png') }}" alt="Logo" class="w-64">
    </a>

        <div class="w-full max-w-xl relative flex">
            <span class="absolute left-4 top-3 text-lg text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" name="search" id="search"
                class="w-full border border-secondary-300 border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none">
            <button
                class="bg-secondary-300 border border-secondary-300 text-white px-8 rounded-r-md hover:bg-transparent hover:text-secondary-300 transition">Search</button>
        </div>

        <div class="flex items-center space-x-4">
            @auth
                <a href="{{route('wishlist.index')}}" class="text-center text-gray-700 hover:text-secondary-300 transition relative">
                    <div class="text-2xl">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="text-xs leading-3">Wishlist</div>
                    <div
                        class="absolute right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-secondary-300 text-white text-xs">
                        {{\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist') -> content() -> count()}}</div>
                </a>
                <a href="{{route('cart.index')}}" class="text-center text-gray-700 hover:text-secondary-300 transition relative">
                    <div class="text-2xl">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-xs leading-3">Cart</div>
                    <div
                        class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-secondary-300 text-white text-xs">
                        {{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content() -> count()}}</div>
                </a>
                <a href="{{route('account.index')}}" class="text-center text-gray-700 hover:text-secondary-300 transition relative">
                    <div class="text-2xl">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="text-xs leading-3">Account</div>
                </a>
                @else
                <a href="#" class="text-center text-gray-700 hover:text-secondary-300 transition relative">
                    <div class="text-2xl">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-xs leading-3">Cart</div>
                    <div
                        class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-secondary-300 text-white text-xs">
                        0</div>
                </a>
            @endauth
        </div>
    </div>
</header>