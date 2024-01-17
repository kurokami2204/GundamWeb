@extends('front-end.app')
@section('content')
<div class="mt-20 bg-gray-100">
    <form action="{{ route('account.password.update') }}" method="POST" role="form">
        @csrf
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Changing password</h2>  
            <div class="space-y-2">
                <div>
                    <label for="password" class="text-gray-600 mb-2 block">Old password</label>
                    <input type="password" name="password" 
                        class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                        placeholder="password">
                </div>
                <div>
                    <label for="password" class="text-gray-600 mb-2 block">New Password</label>
                    <input type="password" name="newpass" 
                        class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                        placeholder="password">
                </div>
                <div>
                    <label for="password" class="text-gray-600 mb-2 block">Re-enter new password</label>
                    <input type="password" name="confirmpass" 
                        class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                        placeholder="password">
                </div>
            </div>
            <div class="md:ml-4 lg-ml-12">
                <div class=" text-red-500 pt-4 italic">
                    @if (session('yes'))
                    <div class="alert text-center alert-success">
                        <p>{{ session('yes') }}</p>
                    </div>
                    @endif
                    @if (session('no1'))
                    <div class="alert text-center alert-success">
                        <p>{{ session('no1') }}</p>
                    </div>
                    @endif
                    @if (session('no2'))
                    <div class="alert text-center alert-success">
                        <p>{{ session('no2') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('account.password.forget')}}" class="text-secondary-300">Forgot password</a>
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="block w-full py-2 text-center text-secondary-300 bg-secondary-300 border border-secondary-300 rounded hover:bg-secondary-300 hover:text-white transition uppercase font-roboto font-medium">Change password</button>
            </div>
        </div>
    </form>
</div>
@endsection