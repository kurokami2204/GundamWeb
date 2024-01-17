@extends('front-end.app')

@section('content')
<div class="container py-4 flex items-center gap-3">
    <a href="{{route('client.home')}}" class="text-primary text-base">
        <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <a href="{{route('account.index')}}" class="text-gray-600 font-medium">Customer Account</a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">My Wishlist account</p>
</div>
<!-- ./breadcrumb -->

<!-- account wrapper -->
<div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

    <!-- sidebar -->
    <div class="col-span-3">
        <div class="px-4 py-3 shadow flex items-center gap-4">
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/customer_avatar') . '/' . $customer->link_img}}" alt="profile"
                    class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
            </div>
            <div class="flex-grow">
                <p class="text-gray-600">Hello,</p>
                <h4 class="text-gray-800 font-medium">{{$customer->name}}</h4>
            </div>
        </div>

        <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <div class="space-y-1 pl-8">
                <a href="#" class="relative text-primary block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-regular fa-address-card"></i>
                    </span>
                    Account management
                </a>
                <a href="{{route('account.info.edit')}}" class="relative hover:text-primary block capitalize transition">
                    Profile information
                </a>
                <a href="{{route('account.password.edit')}}" class="relative hover:text-primary block capitalize transition">
                    Change password
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-solid fa-box-archive"></i>
                    </span>
                    My order history
                </a>
                <a href="#" class="relative hover:text-primary block capitalize transition">
                    My returns
                </a>
                <a href="#" class="relative hover:text-primary block capitalize transition">
                    My cancellations
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-regular fa-credit-card"></i>
                    </span>
                    Payment methods
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-regular fa-heart"></i>
                    </span>
                    My wishlist
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <form action="{{route('client.logout')}}" method="post">
                @csrf
                <button type="submit" class="relative hover:text-primary block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                    Logout
                </button>
                    
                </form>
            </div>

        </div>     
    </div>
    <!-- ./sidebar -->

    <!-- info -->
    <div class="col-span-9 space-y-4">
        @foreach($wishlist as $item)
        <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
            <input type="hidden" name="product_id" value="{{ $item -> id }}">
            <div class="w-36">
                @if($item->options->link_img != null)
                    <img src="{{ asset('storage/product_images') . '/' . ($item->options->link_img)[0] }}" alt="product 1" class="h-full w-full object-cover object-center" />
                    @else
                    <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="h-full w-full object-cover object-center">
                @endif
            </div>
            <div class="w-1/2">
                <a href="{{route('product.detail',['id' => $item->id])}}" class="text-gray-800 hover:text-secondary-300 text-lg font-medium ">{{$item -> name}}</a>
                @if($item -> qty > 0)
                    <p class="text-gray-500 text-sm">Availability: <span class="text-green-600">In Stock</span></p>
                    @else
                    <p class="text-gray-500 text-sm">Availability: <span class="text-red-600">Out of Stock</span></p>
                @endif
            </div>
            <div class="text-primary text-lg font-semibold">{{$item -> price}} đ</div>
            
            <div class="text-gray-600 pr-4 cursor-pointer hover:text-primary">
                <a href="{{route('wishlist.removeItem',['rowId' => $item-> rowId])}}">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <!-- ./info -->
</div>
@endsection