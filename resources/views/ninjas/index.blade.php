<x-app-layout>
<div class="max-w-7xl mx-auto px-4 py-8 mt-4">
  <h2>Currently Available Ninjas</h2>

  <ul>
    @foreach($ninjas as $ninja)
      <li>
        <x-card :highlight="$ninja['skill'] > 70" href="{{route('ninjas.show', $ninja)}}">
          <div>
            <h3>{{ $ninja->name }}</h3>
            <p>{{ $ninja->dojo->name }}</p>
            
            <!-- Vote buttons -->
            <div class="flex items-center gap-4 mt-2">
                <form action="{{ route('ninjas.vote', $ninja) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="type" value="up">
                    <button type="submit" class="text-green-600 hover:text-green-800">
                        👍 {{ $ninja->upVotes()->count() }}
                    </button>
                </form>
                
                <form action="{{ route('ninjas.vote', $ninja) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="type" value="down">
                    <button type="submit" class="text-red-600 hover:text-red-800">
                        👎 {{ $ninja->downVotes()->count() }}
                    </button>
                </form>
            </div>
          </div>
        </x-card>
      </li>
    @endforeach
  </ul>

  {{ $ninjas->links() }}
</div>
</x-app-layout>