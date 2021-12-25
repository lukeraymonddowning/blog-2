<nav class="flex flex-col sm:flex-row px-4 py-2 justify-between items-baseline print:hidden" role="navigation"
     aria-label="Main">
    <ul class="flex space-x-3 mb-6 sm:mb-0 items-center w-full md:w-auto">
        @foreach(navitems() as $item)
            <li>
                <a class="text-zinc-900 dark:text-zinc-200 text-lg pb-1 border-b-2 border-transparent hover:border-teal @if($item->active) border-teal @endif"
                   href="{{ $item->url }}">
                    {{ __($item->name) }}
                </a>
            </li>
        @endforeach
        <li aria-hidden="true" class="sm:hidden flex-1"></li>
        @foreach(navitems('social') as $item)
            <li>
                <a class="text-zinc-900 dark:text-zinc-200 pb-1 transition hover:text-teal"
                   href="{{ $item->url }}">
                    <x-dynamic-component :component="$item->icon" class="h-6"/>
                    <span class="sr-only">{{ __($item->name) }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <form class="w-full sm:w-auto flex" action="{{ route('posts.index') }}">
        <label for="search" class="sr-only">Search for anything</label>
        <input type="search"
               name="search"
               id="search"
               class="flex-grow border-zinc-400 border-l border-b border-t rounded-l pr-0 p-2 text-zinc-700 dark:text-zinc-300 bg-transparent"
               placeholder="The world is your oyster...">
        <button
            class="flex-shrink-0 border-zinc-400 border border-l-0 rounded-r p-2 hover:bg-zinc-100 dark:bg-zinc-300 text-zinc-900"
            type="submit">
            Search
        </button>
    </form>
</nav>
