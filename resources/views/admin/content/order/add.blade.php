@extends('admin.app')

@section('title')
<title>Order</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Order | Add</h1>
        </div>
        <!-- Content -->
        <div>
            <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-lg font-bold mb-2" >
                        Customer information
                        <span class=" text-base">*</span>
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline text-dark"
                        required id ='search_customers'>
                    </select>

                    <script type="text/javascript">
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $(document).ready(function() {
                            $('#search_customers').select2({
                                ajax:{
                                    url:"{{route('admin.order.searchCustomer')}}",
                                    type: 'post',
                                    dataType: 'json',
                                    delay: 250,
                                    data: function(params){
                                        return{
                                            _token: CSRF_TOKEN,
                                            search: params.term,
                                            page: params.page || 1
                                        }
                                    },
                                    processResults: function(response){
                                        return{
                                            results: $.map(response, function (item) {
                                                return {
                                                    id: item.id,
                                                    text: item.name + ', ' + item.email + ', ' + item.phone_number,                                  
                                                    };
                                            })
                                        };
                                    },
                                    cache: true            
                                },
                                placeholder: '--Select customer--'
                            });
                        });
                    </script>     
                </div>
                <div class="mb-6 flex-1">
                    <label class="block text-lg font-bold mb-2" >
                        Order product
                        <span class=" text-base">*</span>
                    </label>
                    <div class="flex mb-6">
                        <select class=" shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline text-dark"
                            required id ='search_products'>
                        </select>
                        <script type="text/javascript">
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $(document).ready(function() {
                                $('#search_products').select2({
                                    ajax:{
                                        url:"{{route('admin.order.searchProduct')}}",
                                        type: 'post',
                                        dataType: 'json',
                                        delay: 250,
                                        data: function(params){
                                            return{
                                                _token: CSRF_TOKEN,
                                                search: params.term,
                                                page: params.page || 1
                                            }
                                        },
                                        processResults: function(response){
                                            return{
                                                results: $.map(response, function (item) {
                                                    return {
                                                        id: item.id,
                                                        text: item.brand + ', ' + item.categorized + ', ' + item.name + ', ' + item.price + ' vnd',                                  
                                                        };
                                                })
                                            };
                                        },
                                        cache: true            
                                    },
                                    placeholder: '--Select product--'
                                });
                            });
                        </script>
                        <button class="add-cart flex-none ml-4 border-2 font-bold px-4 rounded-xl focus:outline-none focus:shadow-outline dark:hover:bg-primary-darker hover:bg-gray-300"
                            type="button" onclick="addProduct()">
                            Update
                        </button>     
                    </div>   
                </div>
                
                <div class="flex mt-6 justify-start border-t py-5 dark:border-primary-darker">
                    <div class="pb-5">
                        <label class="block text-lg font-bold mb-2" >
                            Payment method
                            <span class=" text-base">*</span>
                        </label>
                        <div class="flex justify-left ">
                            <div class="pr-12">
                                <label>Cash</label>
                                <input type="radio" id="typePay" name="typePay" value="0">
                            </div>
                            <div class="pr-10">
                                <label>Bank tranfer</label>
                                <input type="radio" id="typePay" name="typePay" value="1">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex border-t items-center justify-between py-4 lg:py-6 dark:border-primary-darker">
                    <label class="block text-lg font-bold mb-2" >
                        Product list
                        <span class=" text-base">*</span>
                    </label>
                </div>

                <div class="container mt-4 h-screen">
                    <script src="{{ asset('js/cart.js') }}"></script>
                    <div class="flex shadow-md">
                        <div class=" w-3/4 rounded-xl bg-cyan-700 px-10 py-10">
                            <div class="flex flex-col">
                                <div class="flex justify-between border-b pb-8">
                                    <h1 class="font-semibold text-2xl">Cart</h1>
                                </div>
                                <div class="flex mt-10 mb-5 rounded-xl items-center">
                                    <h3 class="font-semibold text-white text-s uppercase w-2/5 text-left">Product name</h3>
                                    <h3 class="font-semibold text-white text-s uppercase w-1/5 text-center">Categorized</h3>
                                    <h3 class="font-semibold text-white text-s uppercase w-1/5 text-center">Brand</h3>
                                    <h3 class="font-semibold text-white text-s uppercase w-1/5 text-center">Quantity</h3>
                                    <h3 class="font-semibold text-white text-s uppercase w-1/5 text-center">Price</h3>
                                    <h3 class="font-semibold text-white text-s uppercase w-1/5 text-center">Action</h3>
                                </div>
                                <div class="flex flex-col cart-result">
                                
                                </div>
                                
                            </div>
                            
                            
                            
                        </div>

                        <div id="summary" class="w-1/4 rounded-xl bg-white text-black px-8 py-10">
                            <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
                            <div class="border-t mt-8">
                                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                                    <div class="">TOTAL COST</div>
                                    <div class="total-price">0 vnd</div>
                                </div>
                            <button class="add-cart bg-indigo-500 rounded-xl font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Create order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        

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
