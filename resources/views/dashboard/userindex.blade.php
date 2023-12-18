<x-app-layout> 
<x-slot name="header"> 
<h2 class="font-semibold text-xl text-gray-800 leading-tight"> 
{{ __('Dashboard') }} 
</h2> 
</x-slot> 
<div class="py-12"> 
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
@if($onOrder) 
<div class="mb-5" role="alert"> 
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2"> 
                    Info Tagihan 
                </div> 
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4  
                    py-3 text-red-700"> 
                    <p> 
                        Anda masih memiliki order yang belum terbayar! 
                    </p> 
                    <p> 
                        <a href="{{ url('/transaction/payment', $onOrder->id) }}"  
                            class="inline-block bg-green-500 hover:bg-green-700  
                                text-white font-bold py-2 px-4 mx-2 rounded"> 
                            Bayar Sekarang 
                        </a> 
                    </p> 
                </div> 
            </div> 
            @endif 
            @if($onCart) 
            <div class="mb-5" role="alert"> 
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2"> 
                    Info Pesanan 
                </div> 
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4  
                    py-3 text-red-700"> 
                    <p> 
                        Anda masih memiliki cart yang belum selesai! 
                    </p> 
                    <p> 
                        <a href="{{ url('/transaction/cart', $onCart->id) }}"  
                            class="inline-block bg-green-500 hover:bg-green-700  
                            text-white font-bold py-2 px-4 mx-2 rounded"> 
                            Pesan Sekarang 
                        </a> 
                    </p> 
                </div> 
            </div> 
            @endif 
            @if(!$onOrder && !$onCart) 
            <div class="mb-5" role="alert"> 
                <div class="bg-blue-500 text-white font-bold rounded-t px-4 py-2"> 
                    Info Tagihan 
                </div> 
                <div class="border border-t-0 border-blue-400 rounded-b bg-blue-100  
                    px-4 py-3 text-blue-700"> 
                    <p> 
                        Anda tidak memiliki order yang belum terbayar! 
                    </p> 
                    <p> 
                        <a href="{{ url('/transaction/order') }}"  
                            class="inline-block bg-green-500 hover:bg-green-700  
                            text-white font-bold py-2 px-4 mx-2 rounded"> 
                            Buat Order 
                        </a> 
                    </p> 
                </div> 
            </div> 
            @endif 
            @if(count($transactions)>0) 
            <div class="bg-white"> 
                <h1>Last Transaction</h1> 
                <table class="table-auto w-full"> 
                    <thead> 
                    <tr> 
                        <th class="border px-6 py-4">Order time</th> 
                        <th class="border px-6 py-4">Food</th> 
                        <th class="border px-6 py-4">Total</th> 
                        <th class="border px-6 py-4">Status</th> 
                    </tr> 
                    </thead> 
                    <tbody> 
                        @foreach($transactions as $item) 
                            <tr> 
                                <td class="border px-6 py-4"> 
                                    {{ $item->created_at }} 
                                </td> 
                                <td class="border px-6 py-4 ">{ 
                                    { $item->quantity }} {{ $item->food->food_name }} 
                                </td> 
                                <td class="border px-6 py-4"> 
                                    {{ number_format($item->total ) }} 
                                </td> 
                                <td class="border px-6 py-4"> 
                                    {{ $item->status }} 
                                </td> 
                            </tr> 
                        @endforeach 
                    </tbody> 
                </table> 
            </div> 
            @endif 
        </div> 
    </div> 
</x-app-layout>