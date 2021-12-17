<x-layout title="Blog">
    <div class="mb-4">
        <x-heading>Blog</x-heading>
        @if($search)
            <span class="block mt-2 text-xs text-gray-700 tracking-widest">Searching for {{ $search }}</span>
        @endif
    </div>

    <x-prose>
        {!! $content !!}
    </x-prose>

    <x-dots/>

    <div class="mb-4">
        <nav>
            <ul>
                @foreach($posts as $post)
                    <li class="mb-8">
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <h4 class="leading-tight text-zinc-900 dark:text-zinc-300">{{ $post->title }}</h4>
                            <span class="text-xs text-zinc-700 dark:text-zinc-400">{{ $post->publish_date->format('d/m/Y') }}</span>
                            <p class="mt-1 text-xs text-zinc-700 dark:text-zinc-400 line-clamp-3">{{ $post->excerpt }}</p>
                        </a>
                    </li>
                @endforeach

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </ul>
        </nav>
    </div>

</x-layout>
