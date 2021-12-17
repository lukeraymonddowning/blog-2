@props(['posts'])
<nav class="mt-8">
    <div class="flex justify-between items-baseline">
        <h2 class="text-xl text-zinc-700 dark:text-zinc-400 mb-2">Latest blog posts</h2>
        <a href="{{ route('posts.index') }}"
           aria-label="Read some of my other blog posts."
           class="text-teal hover:text-teal-dark"
        >Browse all blog posts</a>
    </div>
    <ul class="mt-4 grid md:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->slug) }}" class="block w-full h-full">
                    <h3 class="text-lg text-zinc-800 dark:text-zinc-400 leading-tight md:line-clamp-1">{{ $post->title }}</h3>
                    <span class="text-xs text-zinc-700 dark:text-zinc-500">{{ $post->publish_date->format('d/m/Y') }}</span>
                    <p class="mt-1 text-xs text-zinc-700 dark:text-zinc-500 line-clamp-3">{{ $post->excerpt }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
