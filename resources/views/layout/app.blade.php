<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-meta :title="$title" :description="$description" :keywords="$keywords" :ogImage="$ogImage" :ogUrl="$ogUrl" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/styles/vendors/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendors/normalize.css') }}">
    <link rel=" stylesheet" href="{{ asset('assets/styles/main.css') }}">
    @livewireStyles
</head>

<body>
    <div class=" app-template">
    @include('partials.header')
    <main class="main" id="main">
    <div class="main__page">
        {{ $slot }}
        </div> </main>
        {{-- нужное модальное окно --}}
        <livewire:form.order-form />
        <livewire:form.contact />
        @include('partials.footer')
        </div> <script src="{{ asset('assets/scripts/vendors/swiper.min.js') }}">
        </script>
        <script type="module" src="{{ asset('assets/scripts/app.js') }}"></script>
        @livewireScripts
        </body>

</html>