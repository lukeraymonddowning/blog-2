<x-layout :title="$post->title">
    <div class="mb-4">
        <x-heading class="mb-2">{{ $post->title }}</x-heading>
        <span class="text-xs text-zinc-700 dark:text-zinc-400 tracking-widest">
            Published {{ $post->publish_date->format('d/m/Y') }}
            @if($post->updated_at->startOfDay()->isAfter($post->publish_date->startOfDay()))| Last updated {{ $post->updated_at->format('d/m/Y') }}@endif
        </span>
    </div>

    <p class="text-lg leading-loose text-zinc-600 dark:text-zinc-300">{{ $post->excerpt }}</p>

    @if($post->featured_image)
        <img src="{{ $post->featured_image }}"
             alt="{{ $post->featured_image_caption }}"
             class="my-6"
        />
    @endif

    <x-dots/>

    <x-prose>
        {!! $post->content !!}
    </x-prose>

    <x-slot name="head">
        <x-post-meta :post="$post"/>
    </x-slot>

</x-layout>
