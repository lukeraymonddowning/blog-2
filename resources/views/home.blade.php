<x-layout>
    <x-heading class="mb-4">Hi there!</x-heading>

    <div class="mb-4">
        <x-latest-posts :posts="$latestPosts" />
    </div>

    <x-dots/>

    <x-prose>
        {!! $content !!}
    </x-prose>
</x-layout>
