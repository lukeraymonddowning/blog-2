<footer class="mt-12 mb-6 flex flex-col items-center justify-center px-4 print:hidden">
    <div class="flex items-baseline space-x-4">
        @foreach(navitems('social') as $item)
            <a href="{{ $item->url }}">
                <x-dynamic-component :component="$item->icon"
                                     class="h-8 text-zinc-900 dark:text-zinc-300 transition {{ $item->meta['footerClass'] ?? '' }}"
                />
                <span class="sr-only">{{ __($item->name) }}</span>
            </a>
        @endforeach
    </div>
    <x-dots/>
    <div class="mb-2 text-sm text-zinc-700 dark:text-zinc-400 flex flex-col space-y-2 items-center">
        <span class="block text-center">Hey, I know my rights, and they're all reserved! Keep it cool.</span>
        <span class="block text-center">Code highlighting provided by the excellent
            <a href="https://torchlight.dev" class="text-teal hover:text-teal-dark">torchlight.dev</a>.
        </span>
    </div>
    <nav>
        <ul class="mt-4 flex space-x-2 divide-x divide-zinc-400 text-sm text-zinc-500 dark:text-zinc-300">
            @foreach(navitems('footer') as $item)
                <li>
                    <a href="{{ $item->url }}" class="ml-2 hover:text-zinc-700 hover:dark:text-zinc-50">
                        {{ $item->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</footer>
