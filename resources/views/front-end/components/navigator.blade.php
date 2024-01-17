<nav class="bg-gray-800">
    <div class="container flex">
        <div class="px-8 py-4 bg-secondary-300 flex items-center cursor-pointer relative group">
            <span class="text-white">
                <i class="fa-solid fa-bars"></i>
            </span>
            <span class="capitalize ml-2 text-white">All Categories</span>

            <!-- dropdown -->
            <div
                class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                <a href="{{route('product.index')}}" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                    <!-- <img src="{{ asset('img/front_end/icons/sofa.svg') }}" alt="sofa" class="w-5 h-5 object-contain"> -->
                    <span class="ml-6 text-gray-600 text-sm">Model kits</span>
                </a>
                <a href="{{route('product.index')}}" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                    <!-- <img src="{{ asset('img/front_end/icons/terrace.svg') }}" alt="terrace" class="w-5 h-5 object-contain"> -->
                    <span class="ml-6 text-gray-600 text-sm">Mô hình Gundam</span>
                </a>
                <a href="{{route('product.index')}}" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                    <!-- <img src="{{ asset('img/front_end/icons/bed.svg') }}" alt="bed" class="w-5 h-5 object-contain"> -->
                    <span class="ml-6 text-gray-600 text-sm">Mô hình Nendoroid</span>
                </a>
                <a href="{{route('product.index')}}" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                    <!-- <img src="{{ asset('img/front_end/icons/office.svg') }}" alt="office" class="w-5 h-5 object-contain"> -->
                    <span class="ml-6 text-gray-600 text-sm">Mô hình Figure</span>
                </a>
            </div>
        </div>

        <div class="flex items-center justify-between flex-grow pl-12">
            <div class="flex items-center space-x-6 capitalize">
                <a href="{{route('client.home')}}" class="text-gray-200 hover:text-primary transition">Home</a>
                <a href="{{route('product.index')}}" class="text-gray-200 hover:text-primary transition">Shop</a>
                <a href="#" class="text-gray-200 hover:text-primary transition">About us</a>  
                <a href="#" class="text-gray-200 hover:text-primary transition">Contact us</a>
            </div>
            @auth
                <div></div>
                @else
                <div class="flex items-right space-x-6">
                    <a href="{{route('client.login')}}" class="text-gray-200 hover:text-primary transition">Login</a>
                    <a href="{{route('client.register')}}" class="text-gray-200 hover:text-primary transition ">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>