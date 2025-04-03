@props([
    'title' => '',
    'description' => '',
    'keywords' => [],
    'ogImage' => '',
    'ogUrl' => ''
])

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">

@if(count($keywords) > 0)
    <meta name="keywords" content="{{ implode(', ', $keywords) }}">
@endif

<!-- Open Graph -->
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:url" content="{{ $ogUrl }}">
<meta property="og:type" content="website">

<!-- Дополнительные мета-теги -->
<meta name="robots" content="index, follow">
<meta name="author" content="{{ config('app.name') }}">