<x-layout>
    <h1 class="text-4xl mb-4 text-gray-800 font-semibold">Hi there!</h1>

    <div class="mb-4">
        <x-latest-posts :posts="$latestPosts" />
    </div>

    <x-dots/>

    <div class="max-w-5xl prose">
        {!! $content !!}
    </div>
</x-layout>
