@props(['post'])

<meta property="og:title" content="{{ $post->title }}"/>
<meta property="og:description" content="{{ $post->excerpt }}"/>
@if($post->featured_image)
    <meta property="og:image" content="{{ asset($post->featured_image) }}"/>
@endif
<meta name="twitter:card" content="{{ $post->featured_image ? 'summary_large_image' : 'summary'}}"/>
<meta name="twitter:creator" content="{{ $post->author->name }}"/>

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

<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
