<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {!! __('Order &raquo; Cart') !!}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div>
        @if ($errors->any())
        <div class="mb-5" role="alert">
          <div class="bg-red-500 text-white font-bold rounded-t px-4  
                            py-2">
            There's something wrong!
          </div>
          <div class="border border-t-0 border-red-400 rounded-b  
                            bg-red-100 px-4 py-3 text-red-700">
            <p>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            </p>
          </div>
        </div>
        @endif
        <form class="w-full" method="post">
          @csrf
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide  
                                text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Food
              </label>
              <input value="{{ $transaction->food->food_name }}" class="appearance-none block w-full bg-gray-200  
                                text-gray-700 border border-gray-200 rounded py-3  
                                px-4 leading-tight focus:outline-none  
                                focus:bg-white focus:border-gray-500" type="text" readonly="readonly">
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide  
                                text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Price
              </label>
              <input value="{{ number_format($transaction->food->price) }}" class="appearance-none block w-full bg-gray-200  
                                text-gray-700 border border-gray-200 rounded py-3  
                                px-4 leading-tight focus:outline-none  
                                focus:bg-white focus:border-gray-500" type="text" readonly="readonly">
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide  
text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Quantity
              </label>
              <input value="{{ old('quantity', $transaction->quantity) }}" class="appearance-none block w-full bg-gray-200  
text-gray-700 border border-gray-200 rounded py-3  
px-4 leading-tight focus:outline-none focus:bg-white  
focus:border-gray-500" type="text" name="quantity">
            </div>
          </div>
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <button type="submit" class="bg-green-500  
hover:bg-green-700 text-white font-bold py-2 px-4  
rounded">
                Order
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>