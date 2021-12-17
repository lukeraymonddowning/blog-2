<nav class="flex flex-col sm:flex-row px-4 py-2 justify-between items-baseline" role="navigation" aria-label="Main">
    <div>
        <ul class="flex space-x-2 mb-6 sm:mb-0">
            @foreach(navitems() as $item)
                <li>
                    <a class="text-lg pb-1 border-b-2 border-transparent hover:border-teal @if($item->active) border-teal @endif"
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
               class="flex-grow border-gray-400 border-l border-b border-t rounded-l pr-0 p-2 text-gray-700"
               placeholder="The world is your oyster...">
        <button class="flex-shrink-0 border-gray-400 border border-l-0 rounded-r p-2 hover:bg-gray-100"
                type="submit">
            Search
        </button>
    </form>
</nav>
