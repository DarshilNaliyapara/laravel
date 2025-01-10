<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('chirps.store') }}">
            @csrf
            <textarea
                name="message"
                id="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 bg-black text-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error for="message" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Comment') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-black shadow-sm rounded-lg divide-y">
            @foreach ($chirps as $chirp)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-white">{{ $chirp->user->name }}</span>
                                <small class="ml-2 text-sm text-white">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                            
                                @unless ($chirp->created_at->eq($chirp->updated_at))
                                    <small class="text-sm text-white"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            @if ($chirp->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-white">{{ $chirp->message }}</p>

                        <form action="{{ route('chirps.reply', $chirp) }}" method="get">
                            @csrf
                            <x-primary-button class="mt-4">{{ __('Reply') }}</x-primary-button>
                        </form>

                        <div class="mt-6 space-y-4">
                            @foreach ($replies as $reply)
                            @if($chirp->id === $reply->chirp_id)
                            @csrf
                                <div class="p-4 bg-gray-800 rounded">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            
                                            <span class="text-white font-bold">{{ $reply->user->name }} Replied to {{ $chirp->user->name }}</span>
                                            <small class="ml-2 text-sm text-white">{{ $reply->created_at->format('j M Y, g:i a') }}</small>
                                        </div>
                                        @if ($reply->user->is(auth()->user()))
                                        
                                            @method('delete')
                                        
                           
                            <form action="{{route('chirps.destroyreply', $reply)}}" method="get">
                            <x-primary-button>{{ __('Delete') }}</x-primary-button>
                            </form>
                            @endif
                                    </div>
                                    <p class="mt-2 text-white">{{ $reply->replies }}</p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
