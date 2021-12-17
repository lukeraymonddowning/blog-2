<x-layout title="Blog">
    <h1 class="text-4xl mb-4 text-gray-800 font-semibold">Blog</h1>

    <div class="max-w-5xl">
        {!! $content !!}
    </div>

    <x-dots/>

    <div class="mb-4">
        <nav>
            <ul>
                @foreach($posts as $post)
                    <li class="mb-8">
                        <a href="{{ route('posts.show', $post->slug) }}">
                            <h4 class="leading-tight">{{ $post->title }}</h4>
                            <span class="text-xs text-gray-700">{{ $post->publish_date->format('d/m/Y') }}</span>
                            <p class="mt-1 text-xs text-gray-700 line-clamp-3">{{ $post->excerpt }}</p>
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
