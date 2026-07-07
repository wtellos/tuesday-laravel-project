<x-app-layout>
  <div class="max-w-7xl mx-auto px-4 py-8 mt-4">
  <h2>{{ $ninja->name }}'s Profile</h2>

  {{-- ninja info --}}
  <div class="bg-gray-200 p-4 rounded">
    <p><strong>Skill level:</strong> {{ $ninja->skill }}</p>
    <p><strong>About me:</strong></p>
    <p>{{ $ninja->bio }}</p>
  </div>

  {{-- dojo info --}}
  <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded mt-4">
    <h3>Dojo Information</h3>
    <p><strong>Dojo name:</strong> {{ $ninja->dojo->name }}</p>
    <p><strong>Location:</strong> {{ $ninja->dojo->location }}</p>
    <p><strong>About the Dojo:</strong></p>
    <p>{{ $ninja->dojo->description }}</p>
  </div>

  {{-- delete button --}}
  <form action="{{ route('ninjas.destroy', $ninja->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn my-4 mt-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Delete Ninja</button>
  </form>
</div>
</x-app-layout>