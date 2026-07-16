<x-app-layout>
<div class="max-w-7xl mx-auto px-4 py-8 mt-4">
  <h1 class="text-blue-600 dark:text-sky-400 text-3xl mb-6 ">Currently Available Ninjas 🥷🥷🏼🥷🏽</h1>
  <h4 class="text-blue-600 dark:text-sky-400 text-2xl mb-6 ">{{ $ninjasTotalCount  }} Ninjas to read below:</h4>

  <ul>
    @foreach($ninjas as $ninja)
      <li>
        <x-card :highlight="$ninja['skill'] > 70" href="{{route('ninjas.show', $ninja)}}">
          <div class="ninjaCard border-solid border-indigo-500">
            <h3>{{ $ninja->name }}</h3>
            <p>{{ $ninja->dojo->name }}</p>
            
            <!-- Vote buttons -->
            <div class="flex items-center gap-4 mt-2">
                <form action="{{ route('ninjas.vote', $ninja) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="type" value="up">
                    <button type="submit" class="text-green-600 hover:text-green-800">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">   <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" /> </svg> 
                        {{ $ninja->upVotes()->count() }}
                    </button>
                </form>
                
                <form action="{{ route('ninjas.vote', $ninja) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="type" value="down">
                    <button type="submit" class="text-red-600 hover:text-red-800">
   
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" /></svg>
                
                      {{ $ninja->downVotes()->count() }}
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