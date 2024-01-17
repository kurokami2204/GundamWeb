@extends('front-end.app')

@section('content')
<div class="container py-4 flex items-center gap-3">
    <a href="{{route('client.home')}}" class="text-secondary-300 hover:text-secondary-400 text-base">
        <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <a href="{{route('product.index')}}" class="text-gray-600 hover:text-gray-800 font-medium">Shop</a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Product</p>
</div>
<!-- ./breadcrumb -->

<!-- product-detail -->
<div class="container grid grid-cols-2 gap-6">
    <div>
        @if ($product->link_img ?? 0 != null)
            @if (sizeof($product->link_img) > 1)
                <div id="controls-carousel" class="relative" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative overflow-hidden rounded-lg h-[720px] ">  
                        @foreach ($product->link_img as $img)
                            <div class="hidden duration-700 ease-in-out" {{$loop->first ? 'data-carousel-item = active' : 'data-carousel-item'}}>
                                <img class="absolute w-[720px] block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" src="{{ asset('storage/product_images') . '/' . $img }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-white dark:group-hover:text-gray-800/60" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-6 h-6 text-white dark:text-white dark:group-hover:text-gray-800/60" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
                @else
                <div>
                    <img class="w-full" src="{{ asset('storage/product_images') . '/' . ($product->link_img)[0] }}" alt="">
                </div>   
            @endif
        @else
            <div>
                <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="w-full">
            </div> 
        @endif
    </div>
    

    <form action="{{route('cart.store')}}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product -> id }}">
        <h2 class="text-3xl font-medium uppercase mb-2">{{$product -> name ?? 0}}</h2>
        <div class="flex items-center mb-4">
            <div class="flex gap-1 text-sm text-yellow-400">
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
                <span><i class="fa-solid fa-star"></i></span>
            </div>
            <div class="text-xs text-gray-500 ml-3">(150 Reviews)</div>
        </div>
        <div class="space-y-2">
            <p class="text-gray-800 font-semibold space-x-2">
                <span>Availability: </span>
                @if($product -> unit ?? 0 != null)
                    <span class="text-green-600">In Stock</span>
                    @else
                    <span class="text-red-600">Out of Stock</span>
                @endif    
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Brand: </span>
                <span class="text-gray-600">{{$product -> brand ?? 0}}</span>
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Category: </span>
                <span class="text-gray-600">{{$product -> categorized ?? 0}}</span>
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Series: </span>
                <span class="text-gray-600">{{$product -> series ?? 0}}</span>
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Product line: </span>
                <span class="text-gray-600">{{$product -> product_line ?? 0}}</span>
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Height: </span>
                <span class="text-gray-600">{{$product -> Height ?? 0}}</span>
            </p>
            <p class="space-x-2">
                <span class="text-gray-800 font-semibold">Scale: </span>
                <span class="text-gray-600">{{$product -> scale ?? 0}}</span>
            </p>
        </div>
        <div class="flex items-baseline mb-1 mt-24 space-x-2 font-roboto ">
            @if($product -> price ?? 0 != null)
                <p class="text-3xl text-secondary-300 font-semibold">{{$product -> price ?? 0}} vnd</p>
                @else
                <p class="text-3xl text-gray-400 font-semibold">0 vnd</p>
            @endif
        </div>

        <div class="mt-4">
            <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
            @if($product -> unit != null)
                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                    <!-- <button data-action="decrement" type="button" class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</button> -->
                    <input class="h-8 w-16 text-base flex items-center justify-center" min="1" value="1" name="quantity" type="number">
                    <!-- <button data-action="increment" type="button" class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</div> -->
                </div>
                @else
                <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                    <!-- <button data-action="decrement" type="button" class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">-</button> -->
                    <input class="flex h-8 w-16 text-base flex items-center justify-center" min="0" max="0" value="0" name="quantity" type="number">
                    <!-- <button data-action="increment" type="button" class="h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">+</div> -->
                </div>
            @endif
            <div class="mt-8 flex gap-3 border-b border-gray-200 pb-5 pt-5">
                <button type="submit" name="store" value="cart"
                    class="bg-red-500 border border-secondary-300 text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-secondary-300 transition">
                    <i class="fa-solid fa-bag-shopping"></i> Add to cart
                </button>
                <button type="submit" name="store" value="wishlist"
                    class="border border-gray-300 text-gray-600 px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:text-secondary-300 transition">
                    <i class="fa-solid fa-heart"></i> Wishlist
                </button>
            </div>

            <div class="flex gap-3 mt-4">
                <a href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#"
                    class="text-gray-400 hover:text-gray-500 h-8 w-8 rounded-full border border-gray-300 flex items-center justify-center">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>
    </form>
</div>
<!-- ./product-detail -->

<!-- description -->
<div class="container mt-4 pb-16">
    <h3 class="border-b border-gray-200 font-roboto text-gray-800 pb-3 font-medium">Product details</h3>
    <div class="w-3/5 pt-6">
        <div class="text-gray-600 whitespace-pre">
            {!! $product-> description ?? 0 !!}
        </div>

        <table class="table-auto border-collapse w-full text-left text-gray-600 text-sm mt-6">
            <tr>
                <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Series</th>
                <th class="py-2 px-4 border border-gray-300 ">{{$product -> series ?? 0}}</th>
            </tr>
            <tr>
                <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Height</th>
                <th class="py-2 px-4 border border-gray-300 ">{{$product -> height ?? 0}}</th>
            </tr>
            <tr>
                <th class="py-2 px-4 border border-gray-300 w-40 font-medium">Scale</th>
                <th class="py-2 px-4 border border-gray-300 ">{{$product -> scale ?? 0}}</th>
            </tr>
        </table>
    </div>
</div>
<!-- ./description -->

<!-- related product -->
<div class="container pb-16">
    <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">Related products</h2>
    <div class="grid grid-cols-4 gap-6">
        @foreach($products as $relatedproduct)
            <div class="bg-white shadow rounded overflow-hidden group">
                <div class="relative">
                    @if($relatedproduct -> link_img != null)
                        <img src="{{ asset('storage/product_images') . '/' . ($relatedproduct->link_img)[0] }}" alt="product 1" class="h-[358px] w-full">
                        @else
                        <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="h-[358px] w-full">
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                        justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                        <a href="#"
                            class="text-white text-lg w-9 h-8 rounded-full bg-secondary-300 flex items-center justify-center hover:bg-gray-800 transition"
                            title="view related_product">
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
                    <p class="items-baseline text-sm mb-0.5 text-slade-600 font-sans">{{$relatedproduct -> categorized}} </p>
                    <a href="{{route('product.detail',['id' => $relatedproduct->id])}}">
                        <h4 class="uppercase font-medium mb-2 text-gray-800 hover:text-secondary-300 transition line-clamp-2">
                            {{$relatedproduct -> name}}</h4>
                    </a>
                    <div class="flex items-baseline mb-1 space-x-2">
                        @if($relatedproduct -> price != null)
                            <p class="text-xl text-secondary-300 font-semibold">{{$relatedproduct -> price}} vnd</p>
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
                        @if($relatedproduct -> unit != null)
                            <div class="text-xs text-gray-500 ml-3">({{$relatedproduct -> unit}})</div>
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
        <div class="mt-4 col-span-1">
            {{ $products->links() }}
        </div>
</div>
@endsection