<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="post" action="{{ route('chirps.storereply', $chirp) }}">
            @csrf

            <textarea
                name="replies"
                id="replies"
                placeholder="Reply to {{$chirp->user->name}}"
                class="block bg-black text-white w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            ></textarea>
            <x-input-error for="replies" class="mt-2" />

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Reply') }}</x-primary-button>
                <a href="{{ route('chirps.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
