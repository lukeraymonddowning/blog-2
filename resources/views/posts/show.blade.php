<x-layout :title="$post->title">
    <div class="mb-4">
        <h1 class="mb-2 text-4xl text-gray-800 font-semibold leading-tight">{{ $post->title }}</h1>
        <span
            class="text-xs text-gray-700 tracking-widest">Published {{ $post->publish_date->format('d/m/Y') }} @if($post->updated_at->isAfter($post->publish_date))
                | Last updated {{ $post->updated_at->format('d/m/Y') }}@endif</span>
    </div>

    <p class="text-lg leading-loose text-gray-600">{{ $post->excerpt }}</p>

    @if($post->featured_image)
        <img src="{{ $post->featured_image }}"
             alt="{{ $post->featured_image_caption }}"
             class="mb-6"
        />
    @endif

    <x-dots/>

    <div class="prose max-w-none">
        {!! $post->content !!}
    </div>

    <x-slot name="head">
        <meta property="og:title" content="{{ $post->title }}"/>
        <meta property="og:description" content="{{ $post->excerpt }}"/>
        @if($post->featured_image)
            <meta property="og:image" content="{{ asset($post->featured_image) }}"/>
        @endif
        <meta name="twitter:card" content="{{ $post->featured_image ? 'summary_large_image' : 'summary'}}"/>
        <meta name="twitter:creator" content="{{ $post->author->name }}"/>
    </x-slot>

    <script type="application/ld+json">
    {
        "@context":"http://schema.org",
        "@type": "BlogPosting",
        "image": "{{ $post->featured_image }}",
        "url": "{{ route('posts.show', $post->slug) }}",
        "headline": "{{ $post->title }}",
        "alternativeHeadline": "{{ $post->excerpt }}",
        "dateCreated": "{{ $post->created_at->format('Y-m-d H:i:s') }}",
        "datePublished": "{{ $post->publish_date->format('Y-m-d H:i:s') }}",
        "dateModified": "{{ $post->updated_at->format('Y-m-d H:i:s') }}",
        "inLanguage": "en-GB",
        "isFamilyFriendly": "true",
        "copyrightYear": "{{ $post->updated_at->format('Y') }}",
        "copyrightHolder": "Luke Raymond Downing",
        "author": {
            "@type": "Person",
            "name": "Luke Downing",
            "url": "https://downing.tech"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Luke Downing",
            "url": "https://downing.tech",
            "logo": {
                "@type": "ImageObject",
                "url": "https://downing.tech/assets/downing_tech_logo.png",
                "width":"250",
                "height":"100"
            }
        },
        "mainEntityOfPage": "True",
        "genre":["Programming","Web development"],
        "articleBody": "{{ strip_tags($post->content) }}"
    }





    </script>
</x-layout>
