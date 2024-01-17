@extends('admin.app')

@section('title')
<title>Product</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex-col items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold py-1">
                {{$product -> name}}               
            </h1>
        </div>
        <!-- Content -->
        <div>
            <div class="flex justify-start border-b py-5 dark:border-primary-darker">
                <div class="flex flex-col pl-4 text-center">
                    <div class=" text-gray-500 dark:text-primary-dark text-lg font-medium">
                        Categorized
                    </div>
                    <div class="dark:text-primary-darker text-xl font-bold">
                        {{ $product-> categorized }}
                    </div>
                </div>
          
                <div class="flex flex-col px-20 text-center">
                    <div class=" text-gray-500 dark:text-primary-dark text-lg font-medium">
                        Product line
                    </div>
                    <div class="dark:text-primary-darker text-xl font-bold">
                        {{ $product-> product_line }} 
                    </div>
                </div>            
            </div>

            <div class="border-b dark:border-primary-darker py-5 px-4">
                <div class="dark:text-primary-darker text-xl font-bold">
                    Description
                </div>
                <div class="dark:text-primary-darker text-lg font-medium pt-5 pb-8 whitespace-pre">
                    {!! $product-> description !!}
                </div>

                <div class="dark:text-primary-darker text-xl font-bold pt-5">
                    Product feature
                </div>
            </div>
                
            <div  class="relative shadow-xl px-4">
                    <table class="table-fixed border-1 w-3/5 text-lg text-left text-white-500 dark:text-white-400">
                            <tr >
                                <th>
                                    Brand:
                                </th>
                                <td class="dark:bg-darker">
                                    {{ $product->brand }}  
                                </td>                  
                            </tr>
                            <tr>                        
                                <th>
                                    Series:
                                </th>
                                <td class="dark:bg-darker">
                                    {{ $product->series }}
                                </td>                                   
                            </tr>  
                            <tr>
                                <th>
                                    Scale:
                                </th>
                                <td class="dark:bg-darker">
                                    {{ $product->scale }}
                                </td>     
                            </tr>                  
                            <tr>
                                <th>
                                    Height:
                                </th>
                                <td class="dark:bg-darker">
                                    {{ $product->height }}
                                </td>                        
                            </tr>
                            @if($product->price != null)
                            <tr>
                                <th>
                                    Price:
                                </th>
                                <td class="dark:bg-darker">
                                    {{ $product->price }}
                                </td>                        
                            </tr>
                            @endif
                            @if($product->unit != null) 
                            <tr>
                                <th>
                                    Unit:
                                </th>
                                <td class="dark:bg-darker">
                                    {{ $product->unit }}
                                </td>                        
                            </tr>
                            @endif                            
                    </table>
            </div>

            <div class="border-b py-5 dark:border-primary-darker">
                <div class="flex flex-col">
                    <div class="dark:text-primary-darker text-xl font-bold pl-4 pb-5">
                        Images
                    </div>
                    
                    @if (optional($product->link_img) != null)
                    <div class="dark:text-primary-darker text-xl font-bold">
                        @if (sizeof($product->link_img) > 1)
                        <div id="controls-carousel" class="relative" data-carousel="static">
                            <!-- Carousel wrapper -->
                            <div class="relative overflow-hidden rounded-lg h-[720px] ">  
                                @foreach ($product->link_img as $img)
                                    <div class="hidden duration-700 ease-in-out" {{$loop->first ? 'data-carousel-item = active' : 'data-carousel-item'}}>
                                        <img class="absolute h-[720px] w-[720px] block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" src="{{ asset('storage/product_images') . '/' . $img }}" alt="">
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
                        <div class="h-[720px] flex justify-center items-center">
                            <img class="object-scale-down h-[720px] w-[720px]" src="{{ asset('storage/product_images') . '/' . ($product->link_img)[0] }}" alt="">
                        </div>
                        @endif
                    </div>  
                    @else
                    <div class="h-screen"></div>
                    @endif

                </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
