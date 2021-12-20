<footer class="mt-12 mb-6 flex flex-col items-center justify-center px-4 print:hidden">
    <div class="flex items-baseline space-x-4">
        @foreach(navitems('social') as $item)
            <a href="{{ config('social.twitter') }}">
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
</footer>
