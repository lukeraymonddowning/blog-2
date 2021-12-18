@props(['videos'])
@if($videos->isNotEmpty())
    <nav class="mt-8">
        <div class="flex justify-between items-baseline">
            <h2 class="text-xl text-zinc-700 dark:text-zinc-400 mb-2">Latest videos</h2>
            <a href="{{ config('social.youtube') }}"
               aria-label="See all of my videos on YouTube."
               class="text-teal hover:text-teal-dark"
            >See all videos</a>
        </div>
        <ul class="mt-4 grid md:grid-cols-3 gap-6">
            @foreach($videos as $video)
                <li>
                    <a href="{{ $video->url }}" class="block w-full h-full flex md:flex-col items-center">
                        <img src="{{ $video->thumbnail }}" alt="YouTube thumbnail"
                             class="aspect-square object-cover md:aspect-video w-32 md:w-full">
                        <div class="ml-4 md:ml-0 md:mt-2">
                            <h3 class="text-lg text-zinc-800 dark:text-zinc-400 leading-tight md:line-clamp-1">{{ $video->title }}</h3>
                            <span
                                class="text-xs text-zinc-700 dark:text-zinc-500">{{ $video->published_at->format('d/m/Y') }}</span>
                            <p class="mt-1 text-xs text-zinc-700 dark:text-zinc-500 line-clamp-3">{{ $video->description }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif
