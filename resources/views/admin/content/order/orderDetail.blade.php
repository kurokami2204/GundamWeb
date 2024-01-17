@extends('admin.app')

@section('title')
<title>Customer</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
        @if ($orders->link_img != null)
            <img class="inline object-cover w-16 h-16 mr-2 rounded-full" src="{{ asset('storage/customer_avatar') . '/' . $orders->link_img}}" alt="Profile image"/>
        @endif
            <div>
                <div class="flex">
                    <div class="text-2xl font-semibold mr-2">
                        {{ $orders->name }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div>
            <div class="border-b dark:border-primary-darker py-5 px-4">
                <div class="dark:text-primary-darker text-xl font-bold pb-5">
                    Customer detail
                </div>
                <ul>
                    <li class="flex border dark:border-primary-darker py-3 px-8">
                        <div class="pr-20">
                            Full name:
                        </div>
                        <div class="pl-11">
                            {{ $orders->name }}
                        </div>
                    </li>
                    <li class="flex border dark:border-primary-darker py-3 px-8">
                        <div class="pr-28">
                            Email:
                        </div>
                        <div class="pl-11">
                            {{ $orders->email }}
                        </div>
                    </li>
                    @if ($orders->address != null)
                        <li class="flex border dark:border-primary-darker py-3 px-8">
                            <div class="pr-20">
                                Address:
                            </div>
                            <div class="pl-14">
                                {{ $orders->address }}
                            </div>
                        </li>
                    @endif
                    @if ($orders->phone_number != null)
                        <li class="flex border dark:border-primary-darker py-3 px-8">
                            <div class="pr-20">
                                Phone number:
                            </div>
                            <div class="pl-2">
                                {{ $orders->phone_number }}
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="flex justify-start border-b py-5 dark:border-primary-darker">
            <div class="flex flex-col pl-4 text-center">
                <div class=" text-gray-500 dark:text-primary-dark text-lg font-medium">
                    Product quantity
                </div>
                <div class="dark:text-primary-darker text-xl font-bold">
                    {{ $goods_quantity }}
                </div>
            </div>
        
            <div class="flex flex-col px-20 text-center">
                <div class=" text-gray-500 dark:text-primary-dark text-lg font-medium">
                    Total price
                </div>
                <div class="dark:text-primary-darker text-xl font-bold">
                    {{ $total }} vnd
                </div>
            </div>
        </div>

        <div class="flex justify-start border-b py-5 dark:border-primary-darker">
            <form class="flex-col" method="POST" action="{{ route('admin.order.verify', ['id' => $orders->id])}}">
                @csrf
                <div class="pb-5">
                    <div class="dark:text-primary-darker text-xl font-bold pl-4 pb-5">
                        Payment status
                    </div>
                    <div class="flex justify-left pl-4">
                        <div class="pr-12">
                            <label>Unpaid</label>
                            <input type="radio" id="statusPay" name="statusPay" value="0"
                            @if ($orders->statusPay == 0)
                                checked
                            @endif>
                        </div>
                        <div class="pr-10">
                            <label>Paid</label>
                            <input type="radio" id="statusPay" name="statusPay" value="1"
                            @if ($orders->statusPay == 1)
                                checked
                            @endif>
                        </div>
                    </div>
                </div>

                <div class="pb-5">
                    <div class="dark:text-primary-darker text-xl font-bold pl-4 pb-5">
                        Delivery status
                    </div>
                    <div class="flex justify-between pl-4">
                        <div class="pr-10">
                            <label>Pending</label>
                            <input type="radio" id="statusDeli" name="statusDeli" value="0"
                            @if ($orders->statusDeli == 0)
                                checked
                            @endif>
                        </div>
                        <div class="pr-10">
                            <label>Shipped</label>
                            <input type="radio" id="statusDeli" name="statusDeli" value="1"
                            @if ($orders->statusDeli == 1)
                                checked
                            @endif>
                        </div>
                        <div class="pr-10">
                            <label>Delivered</label>
                            <input type="radio" id="statusDeli" name="statusDeli" value="2"
                            @if ($orders->statusDeli == 2)
                                checked
                            @endif>
                        </div>
                        <div class="pr-10">
                            <label>Cancelled</label>
                            <input type="radio" id="statusDeli" name="statusDeli" value="3"
                            @if ($orders->statusDeli == 3)
                                checked
                            @endif>
                        </div>
                    </div>
                </div>

                <div class="pb-5">
                    <div class="dark:text-primary-darker text-xl font-bold pl-4 pb-5">
                        Payment methods
                    </div>
                    <div class="flex justify-left pl-4">
                        <div class="pr-16">
                            <label>Cash</label>
                            <input type="radio" id="typePay" name="typePay" value="0"
                            @if ($orders->typePay == 0)
                                checked
                            @endif>
                        </div>
                        <div class="pr-10">
                            <label>Bank tranfer</label>
                            <input type="radio" id="typePay" name="typePay" value="1"
                            @if ($orders->typePay == 1)
                                checked
                            @endif>
                        </div>
                    </div>
                </div>

                <button class="ml-4 border-2 font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline dark:hover:bg-primary-darker hover:bg-gray-300" type="submit">
                    Update
                </button>
            </form>
        </div>

        <div class="flex items-center justify-between px-4 py-4 lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">List of Products</h1>
        </div>

        <div class=" w-11/12  mx-auto mx-8  table-auto pb-5">
            {{ $order_detail->links() }}
        </div>
        <div class = "h-screen">
            <table class=" w-11/12  mx-auto mx-8  table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">Name</th>
                        <th class="py-3 px-6 text-center">Categorized</th>
                        <th class="py-3 px-6 text-center">Brand</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Price</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-light">
                    @foreach($order_detail as $order_product)
                    <tr class="border-b border-gray-200 hover:bg-gray-100 hover:text-black">
                        <td class="cart-product-title py-3 px-6 text-left whitespace-nowrap">
                            <a href="{{route('admin.product.detail',['id' => $order_product->id])}}" class="align-middle hover:text-gray-400 border-b-2 border-gray-800">
                            <span class="font-medium">
                                {{ $order_product -> name}} 
                            </span>
                            </a>
                        </td>
                        <td class="cart-product-categorized py-3 px-6 text-center">
                            <span class="font-medium">
                                {{ $order_product -> categorized}} 
                            </span>
                        </td>
                        <td class="cart-product-brand py-3 px-6 text-center">
                            <span class="font-medium">
                                {{ $order_product -> brand }} 
                            </span>
                        </td>
                        <td class="cart-quantity py-3 px-6 text-center">
                            <span class="font-medium">
                                {{ $order_product -> quantity }}
                            </span>
                        </td>
                        <td class="cart-price py-3 px-6 text-center">
                            <span class="font-medium">
                                {{ $order_product -> price}} vnd
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
