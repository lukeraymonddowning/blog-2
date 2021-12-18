<nav class="flex flex-col sm:flex-row px-4 py-2 justify-between items-baseline print:hidden" role="navigation" aria-label="Main">
    <div>
        <ul class="flex space-x-2 mb-6 sm:mb-0">
            @foreach(navitems() as $item)
                <li>
                    <a class="text-zinc-900 dark:text-zinc-200 text-lg pb-1 border-b-2 border-transparent hover:border-teal @if($item->active) border-teal @endif"
                       href="{{ $item->url }}">
                        {{ __($item->name) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <form class="w-full sm:w-auto flex" action="{{ route('posts.index') }}">
        <label for="search" class="sr-only">Search for anything</label>
        <input type="search"
               name="search"
               id="search"
               class="flex-grow border-zinc-400 border-l border-b border-t rounded-l pr-0 p-2 text-zinc-700 dark:text-zinc-300 bg-transparent"
               placeholder="The world is your oyster...">
        <button class="flex-shrink-0 border-zinc-400 border border-l-0 rounded-r p-2 hover:bg-zinc-100 dark:bg-zinc-300 text-zinc-900"
                type="submit">
            Search
        </button>
    </form>
</nav>
