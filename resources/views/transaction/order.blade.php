<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Order &raquo; Pilih Makanan') !!}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php $i = 0; ?>
            @foreach($foods as $item)
            @if($i%2==0)
            <div class="flex">
                @endif
                <div class="w-1/2">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <form method="post">
                            <img class="w-full" src="{{ url('/storage',$item->picture_path) }}" style="height:300px;object-fit:cover" alt="{{ $item->food_name }}">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">
                                    {{ $item->food_name }}
                                </div>
                                <p class="text-gray-700 text-base">
                                    {{ $item->description }}
                                </p>
                                <div class="font-bold text-xl mb-2 w-full  
text-right">
                                    {{ number_format($item->price) }}
                                </div>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <?php $arr_type = explode(',', $item->types); ?>
                                @foreach ($arr_type as $type)
                                <span class="inline-block bg-gray-200  
                                        rounded-full px-3 py-1 text-sm  
                                        font-semibold text-gray-700 mr-2 mb-2">
                                    {{ $type }}
                                </span>
                                @endforeach
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="food_id" />
                                <button type="submit" class="bg-green-500  
                                    hover:bg-green-700 text-white font-bold py-2  
                                    px-4 mx-2 rounded inline-block">
                                    Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if($i%2!=0)
            </div>
            @endif
            <?php $i++; ?>
            @endforeach
        </div>
    </div>
</x-app-layout>