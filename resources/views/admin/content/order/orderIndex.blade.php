@extends('admin.app')

@section('title')
<title>Orders</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">List of Orders</h1>
        </div>
        <!-- Content -->
        <div class=" h-screen">
            <div class="mt-2">
                <div class="overflow-x-auto flex flex-col">
                    <div class="flex flex-row-reverse">
                        <div class="m-6">
                            <a href="{{route('admin.order.create')}}"
                                class="font-bold py-2 px-4 border-2 rounded-lg text-white hover:bg-white hover:text-black focus:outline-none focus:shadow-outline"
                                type="button">
                                Add order
                            </a>
                        </div>
                    </div>
                <div class=" w-11/12  mx-auto mx-8 bg-green-700  table-auto">
                    @if(session()->has('success'))

                        <div class="bg-green-300 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                            <div class="py-1"><i class=" fas fa-check-circle fill-current h-6 w-6 text-green-700 mr-4"> </i></div>

                            <div>

                                <p class="text-lg">{{ session()->get('success') }}</p>
                            </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <div class=" w-11/12  mx-auto mx-8  table-auto pb-5">
                        {{ $orders->links() }}
                    </div>
                    <table class=" w-11/12  mx-auto mx-8  table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Order ID</th>
                                <th class="py-3 px-6 text-center">Customer Name</th>
                                <th class="py-3 px-6 text-center">Customer email</th>
                                <th class="py-3 px-6 text-center">Customer phone number</th>
                                <th class="py-3 px-6 text-center">Status pay</th>
                                <th class="py-3 px-6 text-center">Status deli</th>
                                <th class="py-3 px-6 text-center">Type pay</th>
                                <th class="py-3 px-6 text-center">Created at</th>
                                <th class="py-3 px-6 text-center">Updated at</th>
                                <th class="py-3 px-6 text-center">Total Price</th>
                                <th class="py-3 px-6 text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody class="text-sm font-light">
                            @foreach($orders as $order)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 hover:text-black">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <a href="{{route('admin.order.orderDetail', ['id' => $order->id])}}" class="font-medium hover:text-gray-400 border-b-2 border-gray-800">
                                    <span class="font-medium">
                                        {{ $order -> id_package}} 
                                    </span>
                                    </a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    
                                    <span class="font-medium">
                                        {{ $order -> name}} 
                                    </span>
                                    <!-- </a> -->
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="font-medium">
                                        {{ $order -> email }} 
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="font-medium">
                                        {{ $order -> phone_number}} 
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if ($order->statusPay == 0)
                                    <span class="font-medium">
                                        Unpaid
                                    </span>
                                    @else
                                    <span class="font-medium">
                                        Paid
                                    </span>
                                    @endif     
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if ($order->statusDeli == 0)
                                    <span class="font-medium">
                                        Pending
                                    </span>
                                    @elseif($order->statusDeli == 1)
                                    <span class="font-medium">
                                        Shipped
                                    </span>
                                    @elseif($order->statusDeli == 2)
                                    <span class="font-medium">
                                        Delivered
                                    </span>
                                    @else
                                    <span class="font-medium">
                                        Cancelled
                                    </span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if($order->typePay == 0)
                                    <span class="font-medium">
                                        Cash 
                                    </span>
                                    @else
                                    <span class="font-medium">
                                        Bank tranfer
                                    </span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="font-medium">
                                        {{ $order -> created_at}} 
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="font-medium">
                                        {{ $order -> updated_at}} 
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="font-medium">
                                        {{ $order -> total}} vnd
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                
                                                <i class="fas fa-stamp"></i>
                                            <!-- </a> -->
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            
                                                <i class="fas fa-edit"></i>
                                            <!-- </a> -->
                                        </div>
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <script src="{{ asset('js/backend/bank/index.js') }}"></script>
                                            
                                                <i class="fas fa-trash-alt"></i>
                                            <!-- </a> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
<!-- @section('js')

<script src="{{ asset('js/backend/bank/index.js') }}"></script>
@endsection -->
