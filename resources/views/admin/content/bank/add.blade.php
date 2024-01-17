@extends('admin.app')

@section('title')
<title>Banking accounts</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Banking accounts | Add</h1>
        </div>
        <!-- Content -->
        <div class=" h-screen">
            <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('admin.bank.store')}}" >
                @csrf
                <div class="mb-4">
                    <label class="block  text-sm font-bold mb-2" >
                        Tên ngân hàng
                        <span class=" text-base">*</span>
                    </label>
                    <input value="{{old('bankName')}}" class="@error('bankName') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" id="bankName" name="bankName" type="text" placeholder="Nhập tên ngân hàng">
                </div>
                <div class="mb-4">
                    @error('bankName')
                        <div class=" border border-red-400 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 " role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
             
             
                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                        Chủ tài khoản
                        <span class=" text-base">*</span>
                    </label>
                    <input value="{{old('userName')}}" class="@error('userName') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" id="userName" name="userName" type="text" placeholder="Nhập tên chủ tài khoản">
                </div>
                <div class="mb-6">
                    @error('userName')
                        <div class=" border border-red-400 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 " role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
             
             
                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                        Số tài khoản
                        <span class=" text-base">*</span>
                    </label>
                    <input value="{{old('bankNumber')}}" class="@error('bankNumber') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" id="bankNumber" name="bankNumber" type="text" placeholder="Nhập số tài khoản">
                </div>
                <div class="mb-6">
                    @error('bankNumber')
                        <div class=" border border-red-400 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 " role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block  text-sm font-bold mb-2" >
                    Chi nhánh
                    <span class=" text-base">*</span>
                    </label>
                    <input value="{{old('department')}}" class="@error('department') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline text-dark" id="department" name="department" type="text" placeholder="Nhập vị trí">
                </div>
                <div class="mb-6">
                    @error('department')
                        <div class=" border border-red-400 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 " role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
             
                <div class="flex items-center justify-between">
                    <button class=" border-2 font-bold py-2 px-4 rounded-xl focus:outline-none focus:shadow-outline dark:hover:bg-primary-darker hover:bg-gray-300" type="submit">
                        Thêm mới
                    </button>
                </div>
            </form>
        </div>
        
        
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
@section('js')
 
<script src="{{ asset('js/backend/bank/index.js') }}"></script>
@endsection