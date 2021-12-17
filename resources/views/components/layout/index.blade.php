@props(['title' => null])
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Hi there! My name is Luke Downing, a web developer from the UK, and this is my personal site. Come on in!">
    <title>{{ $title ?: __('Blog') }} | Downing Tech</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">

    {{ $head ?? '' }}

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 leading-normal min-h-screen flex flex-col">
<x-header/>

<main id="main" class="flex-grow leading-relaxed w-full md:w-3/4 max-w-5xl mx-auto">
    <div class="mt-4 mx-4">
        {{ $slot }}
    </div>
</main>
<x-decoration/>
<x-footer/>
</body>
</html>
