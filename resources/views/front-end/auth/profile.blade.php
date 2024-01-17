@extends('front-end.app')

@section('content')
<div class="container py-4 flex items-center gap-3">
    <a href="{{route('client.home')}}" class="text-secondary-300 text-base">
        <i class="fa-solid fa-house"></i>
    </a>
    <span class="text-sm text-gray-400">
        <i class="fa-solid fa-chevron-right"></i>
    </span>
    <p class="text-gray-600 font-medium">Profile</p>
</div>
<!-- ./breadcrumb -->

<!-- wrapper -->
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
                <h4 class="text-gray-800 font-medium">{{$customer -> name}}</h4>
            </div>
        </div>

        <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
            <div class="space-y-1 pl-8">
                <a href="#" class="relative text-secondary-300 block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-regular fa-address-card"></i>
                    </span>
                    Account management
                </a>
                <a href="{{route('account.info.edit')}}" class="relative hover:text-secondary-300 block capitalize transition">
                    Profile information
                </a>
                <a href="{{route('account.password.edit')}}" class="relative hover:text-secondary-300 block capitalize transition">
                    Change password
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="#" class="relative hover:text-secondary-300 block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-solid fa-box-archive"></i>
                    </span>
                    My order history
                </a>
                <a href="#" class="relative hover:text-secondary-300 block capitalize transition">
                    My returns
                </a>
                <a href="#" class="relative hover:text-secondary-300 block capitalize transition">
                    My Cancellations
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="#" class="relative hover:text-secondary-300 block font-medium capitalize transition">
                    <span class="absolute -left-8 top-0 text-base">
                        <i class="fa-regular fa-credit-card"></i>
                    </span>
                    Payment methods
                </a>
            </div>

            <div class="space-y-1 pl-8 pt-4">
                <a href="{{route('wishlist.index')}}" class="relative hover:text-secondary-300 block font-medium capitalize transition">
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
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7">
        <form action="{{route('account.info.update')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <h4 class="text-lg font-medium capitalize mb-4">
                Profile information
            </h4>
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name">Full name
                            <span class=" text-base">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="input-box" placeholder="Input full name" 
                        value="{{ $customer->name }}" required>
                    </div>
                    <div>
                        <label for="email">Email
                            <span class=" text-base">*</span>
                        </label>
                        <input type="email" name="email" id="email" class="input-box" placeholder="Input email"
                                value="{{ $customer->email }}" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="address">Address
                            <span class=" text-base">*</span>
                        </label>
                        <input type="text" name="address" id="address" class="input-box" placeholder="Input address"
                                value="{{ $customer->address }}" required>
                    </div>
                    <div>
                        <label for="phone_number">Phone number</label>
                        <input type="text" name="phone_number" id="phone_number" class="input-box" placeholder="Input phone number"
                                value="{{ $customer->phone_number }}" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="md:w-1/3 lg:ml-12 mt-2 md:mt-8 font-bold">
                        <label class="block text-sm font-bold mb-3">
                            Current avatar
                        </label>
                        <div class="w-2/3 rounded-lg border-dashed flex justify-center items-center">
                            <img class="" src="{{ asset('storage/customer_avatar') . '/' . $customer->link_img}}" alt="">
                        </div>
                    </div>
                    <div class="md:w-1/3 lg:ml-12 mt-2 md:mt-8 font-bold">
                        <div class="mt-3 text-center">
                            <label class="block text-sm font-bold mb-3" style="color: #696969; font-family: Raleway;">
                                New avatar
                            </label>
                            <div class="flex justify-center items-center">
                                <div class="relative h-40 rounded-lg border-dashed border-2 border-black flex justify-center items-center hover:cursor-pointer w-5/6">
                                    <div class="absolute" id="avatar_container">
                                        <div class="flex flex-col items-center ">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-gray-300"></i>
                                            <span class="block text-gray-400 font-normal">
                                                Attach you files here
                                            </span>
                                            <span class="block text-gray-400 font-normal">
                                                or
                                            </span>
                                            <span class="block text-blue-400 font-normal">
                                                Browse files
                                            </span>
                                        </div>
                                    </div>
                                    <input class="h-full w-full opacity-0" id="avatar" name="avatar" type="file"
                                        onchange="avatar_select()">
                                </div>
                            </div>
                            <script src="{{ asset('js/avatarPreview.js') }}"></script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="py-3 px-4 text-center text-secondary-300 bg-white border border-secondary-300 rounded-md hover:bg-secondary-300 hover:text-white transition font-medium">save
                    changes</button>
            </div>
        </form>
    </div>
    <!-- ./info -->

</div>
@endsection