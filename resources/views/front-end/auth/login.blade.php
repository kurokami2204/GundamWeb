@extends('front-end.app')

@section('content')
<div class="contain py-16">
    <form action="{{route('client.login.store')}}" method="POST">
        @csrf
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
            <p class="text-gray-600 mb-6 text-sm">
                welcome back customer
            </p>
            <form action="#" method="post" autocomplete="off">
                <div class="space-y-2">
                    <div>
                        <label for="username" class="text-gray-600 mb-2 block">Username</label>
                        <input type="username" name="username" id="username"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                            placeholder="username">
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                            placeholder="password">
                    </div>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="text-secondary-300 focus:ring-0 rounded-sm cursor-pointer">
                        <label for="remember" class="text-gray-600 ml-3 cursor-pointer">Remember me</label>
                    </div>
                    <a href="{{ route('account.password.forget')}}" class="text-secondary-300">Forgot password</a>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-secondary-300 bg-secondary-300 border border-secondary-300 rounded hover:bg-secondary-300 hover:text-white transition uppercase font-roboto font-medium">Login</button>
                </div>
            </form>
            <!-- login with -->
            <div class="mt-6 flex justify-center relative">
                <div class="text-gray-600 uppercase px-3 bg-white z-10 relative">Or login with</div>
                <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
            </div>
            <div class="mt-4 flex gap-4">
                <button class="w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto font-medium text-sm hover:bg-blue-700" type="button">
                    facebook
                </button>
                <button class="w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm hover:bg-red-500" type="button">
                    google 
                </button>
                    
            </div>
            <!-- ./login with -->

            <p class="mt-4 text-center text-gray-600">Don't have account? 
                <a href="{{route('client.register')}}"
                    class="text-secondary-300">Register now</a>
                </p>
        </div>
    </form>
</div>
@endsection