<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Transaksi') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form class="mb-10 flex" method="get">
        <select name="periode" class="appearance-none bg-blue-500 text-white  
                    border border-gray-200 rounded py-3 px-4 mx-2 leading-tight  
                    focus:outline-none focus:bg-blue-500 focus:border-gray-500" id="grid-last-name">
          <option @if($periode=='MINGGU' ) SELECTED @endif value="MINGGU">MINGGU TERAKHIR</option>
          <option @if($periode=='BULAN' ) SELECTED @endif value="BULAN">BULAN INI</option>
          <option @if($periode=='TAHUN' ) SELECTED @endif value="TAHUN">TAHUN INI</option>
          <option @if($periode=='SEMUA' ) SELECTED @endif value="SEMUA">SEMUA</option>
        </select>
        <select name="status" class="appearance-none bg-blue-500 text-white  
                    border border-gray-200 rounded py-3 px-4 mx-2 leading-tight  
                    focus:outline-none focus:bg-blue-500 focus:border-gray-500" id="grid-last-name">
          <option @if($status=='SEMUA' ) SELECTED @endif value="SEMUA">SEMUA</option>
          <option @if($status=='ORDER' ) SELECTED @endif value="ORDER">ORDER</option>
          <option @if($status=='BAYAR' ) SELECTED @endif value="BAYAR">BAYAR</option>
          <option @if($status=='BATAL' ) SELECTED @endif value="BATAL">BATAL</option>
        </select>
        <input name="q" value="{{ $q }}" class="appearance-none block  
                    bg-gray-200 text-gray-700 border border-gray-200 rounded py-3  
                    px-4 leading-tight focus:outline-none focus:bg-white  
                    focus:border-gray-500" id="grid-last-name" type="text" placeholder="Kunci Pencarian">
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold  
                    py-2 px-4 mx-2 rounded">
          Cari
        </button>
      </form>
      <div class="bg-white">
        <table class="table-auto w-full">
          <thead>
            <tr>
              <th class="border px-6 py-4">ID</th>
              <th class="border px-6 py-4">Waktu</th>
              <th class="border px-6 py-4">Item</th>
              <th class="border px-6 py-4">Pemesan</th>
              <th class="border px-6 py-4">Status</th>
              <th class="border px-6 py-4">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($transaction as $item)
            <tr>
              <td class="border px-6 py-4">{{ $item->id }}</td>
              <td class="border px-6 py-4">
                {{ \Carbon\Carbon::parse($item->created_at) 
                                        ->format('Y-m-d H:i:s') }}
              </td>
              <td class="border px-6 py-4">
                {{ number_format($item->quantity) }}
                {{ $item->food->food_name }}<br />
                Total: {{ number_format($item->total) }}
              </td>
              <td class="border px-6 py-4 ">
                {{ $item->user->name }}<br />
                {{ $item->user->address }} No
                {{ $item->user->house_number }}<br />
                {{ $item->user->city }}
              </td>
              <td class="border px-6 py-4 ">{{ $item->status }}</td>
              <td class="border px-6 py- text-center">
                @if($item->status=='ORDER')
                <form action="{{ url('/transaction/bayar',  
                                        $item->id) }}" method="POST" class="inline-block">
                  @csrf
                  <button type="submit" class="inline-block  
                                        bg-blue-500 hover:bg-blue-700 text-white  
                                        font-bold py-2 px-4 mx-2 rounded">
                    Bayar
                  </button>
                </form>
                <form action="{{ url('/transaction/cancel',  
                                        $item->id) }}" method="POST" class="inline-block">
                  @csrf
                  <button type="submit" class="bg-red-500  
                                        hover:bg-red-700 text-white font-bold py-2  
                                        px-4 mx-2 rounded inline-block">
                    Batal
                  </button>
                </form>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="border text-center p-5">
                Data Tidak Ditemukan
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="text-center mt-5">
        {{ $transaction->links() }}
      </div>
    </div>
  </div>
</x-app-layout>