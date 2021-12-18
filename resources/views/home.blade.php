<x-layout>
    <x-heading class="mb-4">Hi there!</x-heading>

    <div class="mb-4">
        <x-latest-posts :posts="$latestPosts" />
    </div>

    <div class="mb-4">
        <x-latest-videos :videos="$latestVideos" />
    </div>

    <x-dots/>

    <x-prose>
        {!! $content !!}
    </x-prose>
</x-layout>
