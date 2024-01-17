@extends('admin.app')

@section('title')
<title>Banking accounts</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Banking accounts | Edit</h1>
        </div>
        <!-- Content -->
        <div class=" h-screen">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('admin.bank.update',['id'=>$banks->id])}}" >
                @csrf
                <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" >
                    Tên ngân hàng
                    <span class="text-red-500 text-base">*</span>
                </label>
                <input class="@error('bankName') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bankName" name="bankName" type="text" placeholder="Nhập tên ngân hàng" value="{{$banks->bankName}}">
                </div>
                <div class="mb-4">
                    @error('bankName')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
            
            
                <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" >
                    Chủ tài khoản
                    <span class="text-red-500 text-base">*</span>
                </label>
                <input class="@error('userName') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="userName" name="userName" type="text" placeholder="Nhập tên chủ tài khoản" value="{{$banks->userName}}">
                
                </div>
                <div class="mb-6">
                    @error('userName')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
            
            
            
                <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" >
                    Số tài khoản
                    <span class="text-red-500 text-base">*</span>
                </label>
                <input class="@error('bankNumber') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="bankNumber" name="bankNumber" type="text" placeholder="Nhập số tài khoản" value="{{$banks->bankNumber}}">
                
                </div>
                <div class="mb-6">
                    @error('bankNumber')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
            
            
                <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" >
                Chi nhánh
                <span class="text-red-500 text-base">*</span>
                </label>
                <input class="@error('department') is-invalid @enderror shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="department" name="department" type="text" placeholder="Nhập vị trí" value="{{ $banks->department }}">
                
                </div>
                <div class="mb-6">
                    @error('department')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">{{$message}}</strong>
            
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @enderror
                </div>
            
            
            
                <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Cập nhật
                </button>
                
                </div>
            </form>
        </div>
        
        
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection