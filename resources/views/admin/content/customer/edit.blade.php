@extends('admin.app')

@section('title')
<title>Customer manager</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Customer | Edit</h1>
        </div>
        <!-- Content -->
        <div>
            <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('admin.customer.update', ['id' => $customer->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" >
                        Full name
                        <span class=" text-base">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 
                                leading-tight focus:outline-none focus:shadow-outline text-dark" 
                    id="name" name="name" type="text" placeholder="Input full name" 
                    value="{{ $customer->name }}" required>
                </div>
                @error('name')
                <div style="color: red;">
                    {{$message}}
                </div>
                @enderror

                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                        Phone number
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 
                                leading-tight focus:outline-none focus:shadow-outline text-dark"
                    id="phone_number" name="phone_number" type="number" minlength="10" maxlength="11"
                    value="{{ $customer->phone_number }}" placeholder="Input phone number">
                </div>

                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                        Address
                    </label>
                    <div class="relative text-black focus-within:text-gray-400">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                            <button type="button" class="focus:outline-none focus:shadow-outline hover:text-black"
                                onclick="document.getElementById('address').value = ''">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </span>
                        <input type="text" id="address" name="address"
                                class="border border-gray-300 rounded outline-none text-black py-1.5 px-3 w-full focus:outline-none focus:text-gray-900"
                                placeholder="Input address"
                                value="{{ $customer->address }}">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                        Email
                        <span class="text-base">*</span>
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 
                                leading-tight focus:outline-none focus:shadow-outline text-dark"
                            id="email" name="email" type="email" placeholder="Input email"
                            value="{{ $customer->email }}" required>
                </div>
                @error('email')
                <div style="color: red;">
                    {{$message}}
                </div>
                @enderror

                <div class="flex items-center justify-between">
                    <button class=" border-2 font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline dark:hover:bg-primary-darker hover:bg-gray-300" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection