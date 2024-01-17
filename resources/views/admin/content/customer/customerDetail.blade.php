@extends('admin.app')

@section('title')
<title>Customer detail</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
        @if ($customer->link_img != null)
            <img class="inline object-cover w-16 h-16 mr-2 rounded-full" src="{{ asset('storage/customer_avatar') . '/' . $customer->link_img}}" alt="Profile image"/>
        @endif
            <div>
                <div class="flex">
                    <div class="text-2xl font-semibold mr-2">
                        {{ $customer->name }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Content -->
        <div>
            <div class="dark:border-primary-darker py-5 px-4">
                <div class="dark:text-primary-darker text-xl font-bold pb-5">
                    Customer detail
                </div>
                <ul>
                    <li class="flex border dark:border-primary-darker py-3 px-8">
                        <div class="pr-20">
                            Full name:
                        </div>
                        <div class="pl-11">
                            {{ $customer->name }}
                        </div>
                    </li>
                    <li class="flex border dark:border-primary-darker py-3 px-8">
                        <div class="pr-28">
                            Email:
                        </div>
                        <div class="pl-11">
                            {{ $customer->email }}
                        </div>
                    </li>
                    @if ($customer->address != null)
                        <li class="flex border dark:border-primary-darker py-3 px-8">
                            <div class="pr-20">
                                Address:
                            </div>
                            <div class="pl-14">
                                {{ $customer->address }}
                            </div>
                        </li>
                    @endif
                    @if ($customer->phone_number != null)
                        <li class="flex border dark:border-primary-darker py-3 px-8">
                            <div class="pr-20">
                                Phone number:
                            </div>
                            <div class="pl-2">
                                {{ $customer->phone_number }}
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="h-screen flex justify-start border-b py-5 dark:border-primary-darker">
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</div>
@include('admin.components.panel')
@endsection
