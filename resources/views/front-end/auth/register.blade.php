@extends('front-end.app')

@section('content')
<div class="contain py-16">
    <form method="POST" action="{{ route('client.register.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Create an account</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Register for new costumer
            </p>
            <form action="#" method="post" autocomplete="off">
                <div class="space-y-2">
                    <div>
                        <label for="username" class="text-gray-600 mb-2 block">Username</label>
                        <input type="text" name="username" id="username"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                            placeholder="username">
                        @error('username')
                        <div style="color: red;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                            placeholder="email">
                        @error('email')
                        <div style="color: red;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                            placeholder="*******">
                        @error('password')
                        <div style="color: red;">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <label for="confirm" class="text-gray-600 mb-2 block">Confirm password</label>
                        <input type="password" name="confirm" id="confirm"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-secondary-300 placeholder-gray-400"
                            placeholder="*******">
                    </div>
                </div>
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="aggrement" id="aggrement"
                            class="text-secondary-300 focus:ring-0 rounded-sm cursor-pointer">
                        <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer">I have read and agree to the <a
                                href="#" class="text-secondary-300">terms & conditions</a></label>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-secondary-300 border border-secondary-300 rounded hover:bg-transparent hover:text-secondary-300 transition uppercase font-roboto font-medium">create
                        account</button>
                </div>
            </form>

            <!-- login with -->
            <div class="mt-6 flex justify-center relative">
                <div class="text-gray-600 uppercase px-3 bg-white z-10 relative">Or signup with</div>
                <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
            </div>
            <div class="mt-4 flex gap-4">
                <a href="#"
                    class="w-1/2 py-2 text-center text-white bg-blue-800 rounded uppercase font-roboto font-medium text-sm hover:bg-blue-700">facebook</a>
                <a href="#"
                    class="w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm hover:bg-red-500">google</a>
            </div>
            <!-- ./login with -->

            <p class="mt-4 text-center text-gray-600">Already have account? <a href="{{route('client.login')}}"
                    class="text-secondary-300">Login now</a></p>
        </div>
    </form>
</div>
@endsection