@extends('front-end.app')

@section('content')

<div class="bg-neutral-50 py-12">
  <div class="container mx-auto my-12">
    <div class="flex flex-col gap-6 md:flex-row">
      <div class="flex-1 shrink-0 rounded-sm border border-neutral-200 bg-white px-4 py-8 shadow-sm">
        <div class="mb-8">
          <h3 class="text-2xl font-bold">Your cart ({{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content() -> count()}})</h3>
          
        </div>
        <ul role="list" class="-my-6 divide-y divide-neutral-200">
          <!-- product item 1 -->
        @foreach($cart as $item)
            <li class="flex py-6">
                <div class="h-32 w-24 flex-shrink-0 overflow-hidden rounded-sm border bg-neutral-50">
                @if($item->options->link_img != null)
                  <img src="{{ asset('storage/product_images') . '/' . ($item->options->link_img)[0] }}" alt="product 1" class="h-full w-full object-cover object-center" />
                  @else
                  <img src="{{ asset('img/front_end/products/no_image.jpg') }}" alt="product 1" class="h-full w-full object-cover object-center">
                @endif
                </div>

                <div class="ml-4 flex flex-1 flex-col">
                <div>
                    <div class="flex justify-between text-sm text-gray-900">
                    <h3 class="text-base font-bold hover:text-secondary-300"><a href="{{route('product.detail',['id' => $item->id])}}"> {{$item -> name}} </a></h3>
                    <a  class="flex gap-2 font-medium text-neutral-400 hover:text-neutral-900" href="{{route('cart.removeItem',['rowId' => $item-> rowId])}}">
                        <p class="text-xs font-normal">Remove</p>
                        <svg class="h-4 w-4 stroke-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </a>
                    </div>
                    <div class="mt-2">
                    <p class="text-s text-neutral-400">{{$item -> options-> category}}</p>
                    <p class="text-s text-neutral-400">{{$item -> options-> brand}}</p>
                    </div>
                </div>
                <div class="mt-auto flex flex-1 items-end justify-between text-sm">
                    <div class="flex flex-row text-center">
                      <form action="{{route('cart.updateItem',['rowId' => $item-> rowId])}}" method="post" class="flex flex-row text-center">
                        @csrf
                        <button type="submit" name="quantity" value="up" class="flex flex-row items-center mt-1 w-16 rounded border border-gray-500 py-1 pl-8 pr-10 active:border-neutral-500 active:ring-neutral-500 sm:text-sm">+</button>
                        <input type="text" value="{{$item -> qty}}" class="mt-1 w-16 rounded block border-gray-500 py-1 pl-3 pr-10 text-center focus:border-neutral-500 focus:outline-none focus:ring-neutral-500 sm:text-sm">
                        <button type="submit" name="quantity" value="down" class="flex flex-row items-center mt-1 w-16 rounded border border-gray-500 py-1 pl-8 pr-10 active:border-neutral-500 active:ring-neutral-500 sm:text-sm">-</button>
                      </form>
                    </div>

                    <div class="flex">
                    <div class="text-right">
                        <p class="text-sm font-bold text-orange-600">{{$item -> price * $item->qty}} đ</p>
                        <!-- <p class="text-xs text-gray-500">Origineel: <span class="text-sm font-bold line-through">€ 299,85 </span></p> -->
                        <div class="mt-1 flex flex-row items-center gap-2">
                        <svg class="h-3 w-3 rotate-90 stroke-2 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <p class="text-xs font-normal text-neutral-400">included taxes</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </li>

        @endforeach
        </ul>
      </div>

      <!-- Total -->
      <form action="{{route('cart.checkout')}}" method="POST" class="sticky space-y-4 rounded-sm border border-neutral-200 bg-white py-6 px-4 shadow-sm sm:px-6 md:w-1/3">
        @csrf
        <!-- pricing totals -->
        <h4 class="text-2xl font-bold">Total</h4>
        <div class="flex flex-col gap-2">
          <div class="flex justify-between text-base text-gray-900">
            <p>Total</p>
            <p>{{Cart::subTotal()}} đ</p>
          </div>
          <div class="flex justify-between text-base text-gray-900">
            <p>Shipping fee</p>
            <p>0 đ</p>
          </div>
          <div class="flex justify-between text-base text-gray-900">
            <p>Tax</p>
            <p>{{Cart::tax()}} đ</p>
          </div>
          <div class="flex justify-between text-base text-gray-900">
            <p>Discount</p>
            <p>0 đ</p>
          </div>
          <div class="flex flex-row items-center justify-end gap-2">
            <svg class="h-4 w-4 rotate-90 stroke-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            <p class="text-xs font-normal text-neutral-400">Special event</p>
          </div>
          <div class="flex flex-row items-center justify-end gap-2">
            <svg class="h-4 w-4 rotate-90 stroke-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            <p class="text-xs font-normal text-neutral-400">Extra discount</p>
          </div>
          <div>
            <div class="my-2 w-full border-t border-gray-300"></div>
            <div class="flex justify-between text-base font-bold text-gray-900">
              <p>Total</p>
              <p>{{Cart::total()}} đ</p>
            </div>
            <p class="mt-0.5 text-sm text-gray-400">include tax</p>
          </div>
          <!-- checkout button -->
          <div class="mt-auto flex flex-col px-10 pt-4">
            <button name="checkout" value="checkout" class="text-xl text-white bg-red-400 hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring focus:ring-violet-300 border rounded">
                Check Out
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection