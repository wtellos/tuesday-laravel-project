<x-app-layout>
    <div class="max-w-2xl mx-auto py-12 px-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                    Complete Your Profile
                </h2>
                
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Please fill in the missing information below to continue.
                </p>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.complete-profile.update') }}">
                    @csrf

                    @foreach($missingFields as $field => $config)
                        <div class="mb-4">
                            <label for="{{ $field }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $config['label'] }}
                                @if($config['required'])
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>

                            @if($config['type'] === 'select')
                                <select 
                                    id="{{ $field }}"
                                    name="{{ $field }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                    @if($config['required']) required @endif
                                >
                                    <option value="">Select {{ $config['label'] }}</option>
                                    @foreach($config['options'] as $value => $label)
                                        <option value="{{ $value }}" {{ old($field, $user->$field) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input 
                                    type="{{ $config['type'] }}"
                                    id="{{ $field }}"
                                    name="{{ $field }}"
                                    value="{{ old($field, $user->$field) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                    @if($config['required']) required @endif
                                >
                            @endif

                            @error($field)
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>