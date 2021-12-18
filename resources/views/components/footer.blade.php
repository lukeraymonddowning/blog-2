<footer class="mt-12 mb-6 flex flex-col items-center justify-center px-4 print:hidden">
    <div class="flex items-baseline space-x-4">
        <a href="{{ config('social.twitter') }}">
            <x-ri-twitter-line class="h-8 text-zinc-900 hover:text-blue-400 transition" />
            <span class="sr-only">Twitter</span>
        </a>
        <a href="{{ config('social.github') }}">
            <x-ri-github-line class="h-8 text-zinc-900 hover:text-zinc-500 transition" />
            <span class="sr-only">Github</span>
        </a>
        <a href="{{ config('social.youtube') }}">
            <x-ri-youtube-line class="h-8 text-zinc-900 hover:text-red-500 transition" />
            <span class="sr-only">YouTube</span>
        </a>
    </div>
    <x-dots/>
    <div class="mb-2 text-sm text-zinc-700 dark:text-zinc-400 flex flex-col space-y-2 items-center">
        <span class="block text-center">Hey, I know my rights, and they're all reserved! Keep it cool.</span>
        <span class="block text-center">Code highlighting provided by the excellent <a href="https://torchlight.dev" class="text-teal hover:text-teal-dark">torchlight.dev</a>.</span>
    </div>
</footer>
