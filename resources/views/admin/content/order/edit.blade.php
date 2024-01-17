@extends('admin.app')

@section('title')
<title>Product</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Product | Edit</h1>
        </div>
        <!-- Content -->
        <div>
            <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('admin.product.update', ['id' => $product->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block  text-sm font-bold mb-2" >
                        Product name
                        <span class=" text-base">*</span>
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3
                            leading-tight focus:outline-none focus:shadow-outline text-dark"
                        id="name" name="name" rows="3" placeholder="Input product name" required>{{$product -> name}}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-6">
                        <label class="block  text-sm font-bold mb-2" >
                        Categorized                        
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" 
                        id="categorized" name="categorized" type="text" placeholder="Input categorized" value="{{ $product-> categorized }}" required>
                    </div>

                    <div class="mb-6">
                        <label class="block  text-sm font-bold mb-2" >
                        Product line
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark"
                        id="product_line" name="product_line" type="text" placeholder="Input product line" value="{{ $product-> product_line }}" required>
                    </div>

                    <div class="mb-6">
                        <label class="block  text-sm font-bold mb-2" >
                        Brand                        
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark"
                        id="brand" name="brand" type="text" placeholder="Input brand" value="{{ $product-> brand }}" required>
                    </div>

                    <div class="mb-6">
                        <label class="block  text-sm font-bold mb-2" >
                        Series                        
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark"
                        id="series" name="series" type="text" placeholder="Input series" value="{{ $product-> series }}" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                    Scale
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" 
                    id="scale" name="scale" type="text" placeholder="Input scale" value="{{ $product-> scale }}" required>
                </div>

                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                    Height
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark"
                    id="height" name="height" type="text" placeholder="Input height" value="{{ $product-> height }}" required>
                </div>
                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                    Price
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark"
                    id="price" name="price" type="text" placeholder="Input price" value="{{ $product-> price }}">
                </div>
                

                <div>
                    <div class="mb-4">
                        <label class="block  text-sm font-bold mb-2" >
                            Description
                            <span class=" text-base">*</span>
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3
                                leading-tight focus:outline-none focus:shadow-outline text-dark"
                            id="ckeditor" name="description" rows="5" placeholder="Input product description">{{ $product-> description }}</textarea>
                    </div>
                    <script src="{{ asset('js/ckeditor.js') }}"></script>                           
                </div>

                <div class="flex-col mb-6">
                    <div class="flex mb-6">
                        <label class="block  text-sm font-bold mb-2 w-1/5 pt-3" >
                        Unit
                        </label>
                        <div class="flex flex-row h-10 w-1/4 rounded-lg relative bg-transparent mt-1 ">
                            <button data-action="decrement" type="button"
                                class="cart_update h-full w-20 rounded-l cursor-pointer outline-none border-2 dark:hover:bg-primary-darker dark:hover:border-primary-darker">
                                <span class="m-auto text-2xl font-thin">−</span>
                            </button>
                            <input type="number"
                                class="focus:outline-none text-center w-full font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-black outline-none quantity"
                                min="0" value="{{ $product-> unit }}" name="unit">
                            <button data-action="increment" type="button"
                                class="cart_update h-full w-20 rounded-r cursor-pointer border-2 dark:hover:bg-primary-darker dark:hover:border-primary-darker">
                                <span class="m-auto text-2xl font-thin">+</span>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="mb-6">
                    <label class="block text-sm font-bold mb-3">
                        Ảnh/Video
                    </label>
                    <div class="relative h-40 rounded-lg border-dashed border-2 border-black dark:border-primary-dark flex justify-center items-center hover:cursor-pointer">
                        <div class="absolute">
                            <div class="flex flex-col items-center ">
                                <i class="fas fa-cloud-upload-alt fa-3x text-gray-300"></i>
                                <span class="block text-gray-400 font-normal">
                                    Attach you files here
                                </span>
                                <span class="block text-gray-400 font-normal">
                                    or
                                </span>
                                <span class="block text-blue-400 font-normal">
                                    Browse files
                                </span>
                            </div>
                        </div>
                        <input class="h-full w-full opacity-0" id="link_img" name="link_img[]" type="file" multiple="multiple">
                    </div>
                </div>

                @if ($product->link_img != null)
                    <div class="dark:text-primary-darker text-xl font-bold pb-10">
                        @if (sizeof($product->link_img) > 1)
                            <div class="product-slider relative flex flex-wrap justify-around w-full"
                                id="productList">
                                <div class="splide__arrows hidden lg:block">
                                    <button type="button"
                                        class="splide__arrow splide__arrow--prev text-xl hover:bg-primary-dark text-black dark:text-primary-dark hover:text-white bg-gray-300">
                                        <i class="fas fa-caret-left"></i>
                                    </button>
                                    <button type="button"
                                        class="splide__arrow splide__arrow--next text-xl hover:bg-primary-dark text-black dark:text-primary-dark hover:text-white bg-gray-300">
                                        <i class="fas fa-caret-right"></i>
                                    </button>
                                </div>
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($product->link_img as $img)
                                            <li class="text-center splide__slide px-3">
                                                <img class="" src="{{ asset('storage/product_images') . '/' . $img }}" alt="">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            <img class="" src="{{ asset('storage/product_images') . '/' . ($product->link_img)[0] }}" alt="">
                        @endif
                    </div>
                @endif

                <div class="flex items-center justify-between">
                    <button class=" border-2 font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline dark:hover:bg-primary-darker hover:bg-gray-300" type="submit">
                        Update product
                    </button>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (document.getElementsByClassName('product-slider')[0]) {
                    new Splide('.product-slider', {
                        perPage: 3,
                        type: 'loop',
                        autoplay: true,
                        pauseOnHover: false,
                    }).mount();
                }
            });
        </script>

        <script>
            function decrement(e) {
                const btn = e.target.parentNode.parentElement.querySelector(
                    'button[data-action="decrement"]'
                );
                const target = btn.nextElementSibling;
                let value = Number(target.value);
                value--;
                if (value < 0) {
                    target.value = 0;
                } else {
                    target.value = value;
                }
            }

            function increment(e) {
                const btn = e.target.parentNode.parentElement.querySelector(
                    'button[data-action="decrement"]'
                );
                const target = btn.nextElementSibling;
                let value = Number(target.value);
                value++;
                target.value = value;
            }
            onLoad();

            function onLoad() {
                const decrementButtons = document.querySelectorAll(
                    `button[data-action="decrement"]`
                );

                const incrementButtons = document.querySelectorAll(
                    `button[data-action="increment"]`
                );

                decrementButtons.forEach(btn => {
                    btn.addEventListener("click", decrement);
                });

                incrementButtons.forEach(btn => {
                    btn.addEventListener("click", increment);
                });
            }
        </script>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
