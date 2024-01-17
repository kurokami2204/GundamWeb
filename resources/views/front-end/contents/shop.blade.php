@extends('front-end.app')

@section('content')
<div class="container py-4 flex items-center gap-3">
    <a href="{{route('client.home')}}" class="text-secondary-300 text-base">
        <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Shop</p>
</div>
<!-- ./breadcrumb -->

<!-- shop wrapper -->
<div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start">
    <!-- sidebar -->
    <script type="text/javascript">
       function filterProduct(){
            var category = document.querySelectorAll('category').innerText;
            var array = [];
            for(var i=0; i < category.length; i++) { 
                array += category[i].value + ",";
            }
            console.log(array);
       }
    </script>
    <div class="col-span-1 bg-white px-4 pb-6 shadow rounded overflow-hidden">
        <div class="divide-y divide-gray-200 space-y-5">
            <div>
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Categories</h3>
                <div class="space-y-2 indicator">
                    <div class="flex items-center">
                        <input type="checkbox" onchange="filterProduct()" id="cat-1" data-filter ="All" value="All" checked
                            class="cat-1 text-secondary-300 focus:ring-0 cursor-pointer">
                        <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">All</label>
                        <div class="ml-auto text-gray-600 text-sm">(15)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" onchange="filterProduct()" id="cat-1" data-filter ="Mô hình Gundam" value="Mô hình Gundam"
                            class="cat-1 text-secondary-300 focus:ring-0 cursor-pointer">
                        <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Mô hình Gundam</label>
                        <div class="ml-auto text-gray-600 text-sm">(15)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" onchange="filterProduct()" id="cat-1" data-filter ="Model kits" value="Model kits"
                            class="cat-1 text-secondary-300 focus:ring-0 cursor-pointer">
                        <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Model kits</label>
                        <div class="ml-auto text-gray-600 text-sm">(9)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" onchange="filterProduct()" id="cat-1" data-filter ="Mô hình Figure" value="Mô hình Figure"
                            class="cat-1 text-secondary-300 focus:ring-0 cursor-pointer">
                        <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Mô hình Figure</label>
                        <div class="ml-auto text-gray-600 text-sm">(21)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" onchange="filterProduct()" id="cat-1" data-filter ="Mô hình Nendoroid" value="Mô hình Nendoroid"
                            class="cat-1 text-secondary-300 focus:ring-0 cursor-pointer">
                        <label for="cat-1" class="text-gray-600 ml-3 cusror-pointer">Mô hình Nendoroid</label>
                        <div class="ml-auto text-gray-600 text-sm">(10)</div>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Brands</h3>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="brand-1" id="brand-1"
                            class="text-secondary-300 focus:ring-0 rounded-sm cursor-pointer">
                        <label for="brand-1" class="text-gray-600 ml-3 cusror-pointer">Bandai</label>
                        <div class="ml-auto text-gray-600 text-sm">(15)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="brand-2" id="brand-2"
                            class="text-secondary-300 focus:ring-0 rounded-sm cursor-pointer">
                        <label for="brand-2" class="text-gray-600 ml-3 cusror-pointer">Kotobukiya</label>
                        <div class="ml-auto text-gray-600 text-sm">(9)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="brand-3" id="brand-3"
                            class="text-secondary-300 focus:ring-0 rounded-sm cursor-pointer">
                        <label for="brand-3" class="text-gray-600 ml-3 cusror-pointer">Good Smile Company</label>
                        <div class="ml-auto text-gray-600 text-sm">(21)</div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="brand-4" id="brand-4"
                            class="text-secondary-300 focus:ring-0 rounded-sm cursor-pointer">
                        <label for="brand-4" class="text-gray-600 ml-3 cusror-pointer">Furyu</label>
                        <div class="ml-auto text-gray-600 text-sm">(10)</div>
                    </div>
                </div>
            </div> 

            <div class="pt-4">
                <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                <div class="mt-4 flex items-center">
                    <input type="text" name="min" id="min"
                        class="w-full border-gray-300 focus:border-secondary-300 rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                        placeholder="min">
                    <span class="mx-3 text-gray-500">-</span>
                    <input type="text" name="max" id="max"
                        class="w-full border-gray-300 focus:border-secondary-300 rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                        placeholder="max">
                </div>
            </div>

        </div>
    </div>
    <!-- ./sidebar -->

    <!-- products -->
    <div class="col-span-3">
        <div class="flex items-center mb-4">
            <select name="sort" id="sort"
                class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-secondary-300 focus:border-secondary-300">
                <option value="">Default sorting</option>
                <option value="price-low-to-high">Price low to high</option>
                <option value="price-high-to-low">Price high to low</option>
                <option value="latest">Latest product</option>
            </select>

            <div class="flex gap-2 ml-auto">
                <div
                    class="border border-secondary-300 w-10 h-9 flex items-center justify-center text-white bg-secondary-300 rounded cursor-pointer">
                    <i class="fa-solid fa-grip-vertical"></i>
                </div>
                <div
                    class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>
        </div>
        @if(session('message'))
            <div class="border rounded bg-secondary-300 text-white text-center">{{session('message')}}</div>
        @endif  
        <div class="grid grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="product-card bg-white shadow rounded overflow-hidden group">
                    <form action="{{route('cart.store')}}" method="POST">
                        @csrf
                        <div class="relative">
                            @if($product -> link_img != null)
                                <img src="{{ asset('storage/product_images') . '/' . ($product->link_img)[0] }}" alt="product 1" class="h-[358px] w-full">
                                @else
                                <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="h-[358px] w-full">
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                                justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{route('product.detail',['id' => $product->id])}}"
                                    class="text-white text-lg w-9 h-8 rounded-full bg-red-500 flex items-center justify-center hover:bg-gray-800 transition"
                                    title="view product">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                                <button type="submit" name="store" value="wishlist"
                                    class="text-white text-lg w-9 h-8 rounded-full bg-red-500 flex items-center justify-center hover:bg-gray-800 transition"
                                    title="add to wishlist">
                                    <i class="fa-solid fa-heart"></i>
                                </button> 
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product -> id }}">
                        <div class="pt-4 pb-3 px-4">
                            <p class="category items-baseline text-sm mb-0.5 text-slade-600 font-sans">{{$product -> categorized}} </p>
                            <a href="{{route('product.detail',['id' => $product->id])}}">
                                <h4 class="uppercase font-medium mb-2 text-gray-800 hover:text-secondary-300 transition line-clamp-2">
                                    {{$product -> name}}</h4>
                            </a>
                            @if($product -> unit != null)
                                <div class="flex items-center mb-1">
                                    @if($product -> price != null)
                                        <p class="flex text-xl text-secondary-300 font-semibold">{{$product -> price}} đ</p>
                                        <input type="number" value="1" name="quantity" class="cart-quantity ml-auto text-gray-600 text-sm  w-14 h-7 rounded">
                                        @else
                                        <p class="items-baseline text-xl text-secondary-300 font-semibold">0 vnd</p>
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
                                    
                                        <div class="text-xs text-gray-500 ml-3">({{$product -> unit}})</div>
                                </div>
                                    
                            @else
                                <div class="flex items-center mb-1">
                                    @if($product -> price != null)
                                        <p class="flex text-xl text-secondary-300 font-semibold">{{$product -> price}} vnd</p>
                                        @else
                                        <p class="items-baseline text-xl text-secondary-300 font-semibold">0 vnd</p>
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
                                    
                                    <div class="text-xs text-gray-500 ml-3">(0)</div>
                                </div>               
                            @endif   
                        </div>
                        @if($product -> unit != null)
                            <button type="submit" name="store" value="cart"
                                class="block w-full py-1 text-center text-white bg-red-400 border rounded-b hover:bg-red-500 active:bg-red-800 hover:text-white transition">Add
                                to cart</button>
                        @else
                        <button type="submit" disabled
                                class="block w-full py-1 text-center text-white bg-red-400 border rounded-b active:bg-red-800 transition">Add
                                to cart</button>
                        @endif
                    </form>
                </div>
            @endforeach
        </div>
        <div class="mt-4 col-span-1">
            {{ $products->links() }}
        </div>
    </div>
    <!-- ./products -->
</div>
@endsection