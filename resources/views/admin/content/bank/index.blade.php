@extends('admin.app')

@section('title')
<title>Banking accounts</title>
@endsection

@section('content')
<div class="flex-1 h-full overflow-x-hidden overflow-y-auto ">
    @include('admin.components.header')
    <main>
        <div class="flex items-center justify-between px-4 py-4 border-b lg:py-6 dark:border-primary-darker">
            <h1 class="text-2xl font-semibold">Banking accounts</h1>
        </div>
        <!-- Content -->
        <div class=" h-screen">
            <div class="mt-2">
                <div class="overflow-x-auto flex flex-col">
                    @if(auth()->user()->can('create bank account'))
                        <div class="flex flex-row-reverse">
                            <div class="m-6">
                                <a href="{{route('admin.bank.create')}}"
                                    class="font-bold py-2 px-4 border-2 rounded-lg text-black hover:bg-white focus:outline-none focus:shadow-outline"
                                    type="button">
                                    Thêm số tài khoản
                                </a>
                            </div>
                        </div>
                    @endif

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
                        {{ $banks->links() }}
                    </div>
                    <table class=" w-11/12  mx-auto mx-8  table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Tên ngân hàng</th>
                                <th class="py-3 px-6 text-left">Tên khách hàng</th>
                                <th class="py-3 px-6 text-left">Số tài khoản</th>
                                <th class="py-3 px-6 text-left">Chi nhánh</th>
                                @if(auth()->user()->can('edit bank account') || auth()->user()->can('delete bank account'))
                                    <th class="py-3 px-6 text-center">Hành động</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody class="text-sm font-light">
                            @foreach($banks as $bank)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 hover:text-black">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$bank->bankName}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{$bank->userName}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">

                                        </div>
                                        <span class="font-medium">{{$bank->bankNumber}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">

                                        </div>
                                        <span class="font-medium">{{$bank->department}}</span>
                                    </div>
                                </td>
                                @if(auth()->user()->can('edit bank account') || auth()->user()->can('delete bank account'))
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex item-center justify-center">
                                            @if(auth()->user()->can('edit bank account'))
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <a href="{{ route('admin.bank.edit', ['id' => $bank->id]) }}" class="">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if (auth()->user()->can('delete bank account'))
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <script src="{{ asset('js/backend/bank/index.js') }}"></script>
                                                    <a class="" onclick="myFunction();" href="{{ route('admin.bank.delete', ['id' => $bank->id]) }}" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            @endif

                                        </div>
                                    </td>
                                @endif
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
