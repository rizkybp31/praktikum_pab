<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('User') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mb-10">
        <a href="{{ url('/user/create') }}" class="bg-green-500 
hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
          + Create User
        </a>
      </div>
      <div class="bg-white">
        <table class="table-auto w-full">
          <thead>
            <tr>
              <th class="border px-6 py-4">Name</th>
              <th class="border px-6 py-4">Email</th>
              <th class="border px-6 py-4">Roles</th>
              <th class="border px-6 py-4">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($user as $item)
            <tr>
              <td class="border px-6 py-4 ">{{ $item->name }}</td>
              <td class="border px-6 py-4">{{ $item->email }}</td>
              <td class="border px-6 py-4">{{ $item->roles }}</td>
              <td class="border px-6 py-text-center">
                <a href="{{ url('/user/edit/'.$item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 
rounded">
                  Edit
                </a>
                @if($item->roles=='USER')
                <a href="{{ url('/user/edituser/'.$item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mx-2 
rounded">
                  User
                </a>
                @endif
                <a href="{{ url('/user/editpassword/'.$item->id) 
}}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 
mx-2 rounded">
                  Password
                </a>
                <form action="{{ url('/user/destroy/'.$item->id) 
}}" method="POST" class="inline-block">
                  @csrf
                  <button type="submit" class="bg-red-500 
hover:bg-red-700 text-white font-bold py-2 px-4 mx-2 rounded inline-block" onclick="return confirm('Are you sure?')">
                    Delete
                  </button>
                </form>
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
        {{ $user->links() }}
      </div>
    </div>
  </div>
</x-app-layout>