<x-layout :title="$post->title">
    <div class="mb-4">
        <h1 class="mb-2 text-4xl text-gray-800 font-semibold leading-tight">{{ $post->title }}</h1>
        <span
            class="text-xs text-gray-700 tracking-widest">Published {{ $post->publish_date->format('d/m/Y') }} @if($post->updated_at->isAfter($post->publish_date))
                | Last updated {{ $post->updated_at->format('d/m/Y') }}@endif</span>
    </div>

    <p class="text-lg leading-loose text-gray-600">{{ $post->excerpt }}</p>

    @if($post->featured_image)
        <img src="{{ $post->featured_image }}"
             alt="{{ $post->featured_image_caption }}"
             class="mb-6"
        />
    @endif

    <x-dots/>

    <div class="prose max-w-none">
        {!! $post->content !!}
    </div>

    <x-slot name="head">
        <x-post-meta :post="$post"/>
    </x-slot>


</x-layout>
