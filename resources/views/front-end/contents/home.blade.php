@extends('front-end.app')

@section('content')
<div class="bg-cover bg-no-repeat bg-center py-36 h-[720px] " style="background-image: url('{{ asset('img/front_end/wallpaper.jpg') }}');">
        <div class="container">
            <h1 class="text-6xl text-gray-800 font-medium mb-4 capitalize">
                RX-78-2 GUNDAM
            </h1>
            <h2 class="text-4xl text-gray-800 font-medium mb-4 capitalize">
                E.F.S.F PROTOTYPE <br>
                CLOSE-COMBAT MOBILE SUIT 
            </h2>
            <p>The RX-78-2 Gundam is the titular mobile suit of Mobile Suit Gundam television series.<br>
            The Gundam would turn the tide of war in favor of the Earth Federation <br>
            during the One Year War against the Principality of Zeon.</p>
            <div class="mt-12">
                <a href="{{route('product.index')}}" class="bg-secondary-300 border border-secondary-300 text-white px-8 py-3 font-medium 
                    rounded-md hover:bg-transparent hover:text-secondary-300">Shop Now</a>
            </div>
        </div>
    </div>
    <!-- ./banner -->

    <!-- features -->
    <div class="container py-16">
        <div class="w-10/12 grid grid-cols-3 gap-6 mx-auto justify-center">
            <div class="border border-secondary-300 rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="{{ asset('img/front_end/icons/delivery-van.svg') }}" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Free Shipping</h4>
                    <p class="text-gray-500 text-sm">Order over 500.000đ</p>
                </div>
            </div>
            <div class="border border-secondary-300 rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="{{ asset('img/front_end/icons/money-back.svg') }}" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Money Returns</h4>
                    <p class="text-gray-500 text-sm">30 days money returns</p>
                </div>
            </div>
            <div class="border border-secondary-300 rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                <img src="{{ asset('img/front_end/icons/service-hours.svg') }}" alt="Delivery" class="w-12 h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">24/7 Support</h4>
                    <p class="text-gray-500 text-sm">Customer support</p>
                </div>
            </div>
        </div>
    </div>
    <!-- ./features -->

    <!-- categories -->
    <div class="container py-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">shop by category</h2>
        <div class="grid grid-cols-4 gap-3">
            <div class="relative rounded-sm overflow-hidden group">
                <img src="{{ asset('img/front_end/category/modelkit.jpg') }}" alt="category 1" class="w-full">
                <a href="{{route('product.index')}}"
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">Model kits</a>
            </div>
            <div class="relative rounded-sm overflow-hidden group">
                <img src="{{ asset('img/front_end/category/gundam.jpg') }}" alt="category 1" class="w-full">
                <a href="{{route('product.index')}}"
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">Gundam</a>
            </div>
            <div class="relative rounded-sm overflow-hidden group">
                <img src="{{ asset('img/front_end/category/nendoroid.jpg') }}" alt="category 1" class="w-full">
                <a href="{{route('product.index')}}"
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">Nendoroid
                </a>
            </div>
            <div class="relative rounded-sm overflow-hidden group">
                <img src="{{ asset('img/front_end/category/figure.jpg') }}" alt="category 1" class="w-full">
                <a href="{{route('product.index')}}"
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">Figure</a>
            </div>
            </div>
        </div>
    </div>
    <!-- ./categories -->

    <!-- new arrival -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">top new arrival</h2>
        <div class="grid grid-cols-4 gap-6">   
            @foreach($products->slice(0,4) as $product)
                <div class="bg-white shadow rounded overflow-hidden group">
                    <div class="relative">
                        @if($product -> link_img != null)
                            <img src="{{ asset('storage/product_images') . '/' . ($product->link_img)[0] }}" alt="product 1" class="h-[358px] w-full">
                            @else
                            <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="h-[358px] w-full">
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                            justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-secondary-300 flex items-center justify-center hover:bg-gray-800 transition"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-secondary-300 flex items-center justify-center hover:bg-gray-800 transition"
                                title="add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pt-4 pb-3 px-4">
                        <p class="items-baseline text-sm mb-0.5 text-slade-600 font-sans">{{$product -> categorized}} </p>
                        <a href="{{route('product.detail',['id' => $product->id])}}">
                            <h4 class="uppercase font-medium mb-2 text-gray-800 hover:text-secondary-300 transition line-clamp-2">
                                {{$product -> name}}</h4>
                        </a>
                        <div class="flex items-baseline mb-1 space-x-2">
                            @if($product -> price != null)
                                <p class="text-xl text-secondary-300 font-semibold">{{$product -> price}} vnd</p>
                                @else
                                <p class="text-xl text-secondary-300 font-semibold">0 vnd</p>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                            </div>
                            @if($product -> unit != null)
                                <div class="text-xs text-gray-500 ml-3">({{$product -> unit}})</div>
                                @else
                                <div class="text-xs text-gray-500 ml-3">(0)</div>
                            @endif
                        </div>
                    </div>
                    <a href="#"
                        class="block w-full py-1 text-center text-white bg-secondary-300 border border-secondary-300 rounded-b hover:bg-transparent hover:text-secondary-300 transition">Add
                        to cart</a>
                </div>
            @endforeach           
        </div>
    </div>
    <!-- ./new arrival -->

    <!-- ads -->
    <div class="container pb-16">
        <a href="#">
            <img src="{{ asset('img/front_end/offer.jpg') }}" alt="ads" class="w-full">
        </a>
    </div>
    <!-- ./ads -->

    <!-- product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">recomended for you</h2>
        <div class="grid grid-cols-4 gap-6">
            @foreach($products->slice(0,8) as $product)
                <div class="bg-white shadow rounded overflow-hidden group">
                    <div class="relative">
                        @if($product -> link_img != null)
                            <img src="{{ asset('storage/product_images') . '/' . ($product->link_img)[0] }}" alt="product 1" class="h-[358px] w-full">
                            @else
                            <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="h-[358px] w-full">
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                            justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-secondary-300 flex items-center justify-center hover:bg-gray-800 transition"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-secondary-300 flex items-center justify-center hover:bg-gray-800 transition"
                                title="add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pt-4 pb-3 px-4">
                        <p class="items-baseline text-sm mb-0.5 text-slade-600 font-sans">{{$product -> categorized}} </p>
                        <a href="{{route('product.detail',['id' => $product->id])}}">
                            <h4 class="uppercase font-medium mb-2 text-gray-800 hover:text-secondary-300 transition line-clamp-2">
                                {{$product -> name}}</h4>
                        </a>
                        <div class="flex items-baseline mb-1 space-x-2">
                            @if($product -> price != null)
                                <p class="text-xl text-secondary-300 font-semibold">{{$product -> price}} vnd</p>
                                @else
                                <p class="text-xl text-secondary-300 font-semibold">0 vnd</p>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                            </div>
                            @if($product -> unit != null)
                                <div class="text-xs text-gray-500 ml-3">({{$product -> unit}})</div>
                                @else
                                <div class="text-xs text-gray-500 ml-3">(0)</div>
                            @endif
                        </div>
                    </div>
                    <a href="#"
                        class="block w-full py-1 text-center text-white bg-secondary-300 border border-secondary-300 rounded-b hover:bg-transparent hover:text-secondary-300 transition">Add
                        to cart</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection