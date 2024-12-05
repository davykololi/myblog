<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-language" :content="en_US">
        <meta http-equiv="X-UA-Compatible" :content="ie=edge, chrome=1">
        <meta name="developer" :content="David Misiko Kololi">
        <meta name="developer:email" :content="kololimdavid@gmail.com">
        <meta name="designer" :content="David Misiko Kololi">
        <meta name="fb:app_id" :content="90876954">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link rel="stylesheet" href="{{ asset('css/share-buttons.css') }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <!-- ========== Favicon Icon ========== -->
        <link rel="shortcut icon" href="{{ asset('static/my-logo.png') }}" type="image/x-icon">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <!-- rss feed -->
        @include('feed::links')

        <style>
            .main-background {
                background-image: url('/static/lensa.jpg');
            }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-slate-900" style="background: #edf2f7;">
        @inertia
    <!-- Implement the Back Top Top Button -->
    <button id="to-top-button" onclick="goToTop()" title="Go To Top"
        class="back-button hidden fixed z-[90]">&uarr;
    </button>
    </body>
    <!-- Dark mode toggle -->
    <script defer>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleMode() {
            const theme = localStorage.getItem('theme');

            if (typeof theme === 'string' && theme === 'dark') {
                localStorage.removeItem('theme');
                document.documentElement.classList.remove('dark');
            } else {
                localStorage.setItem('theme', 'dark');
                document.documentElement.classList.add('dark');
            }
        }
    </script>

    <!-- Javascript code -->
    <script defer>
        var toTopButton = document.getElementById("to-top-button");

        // When the user scrolls down 200px from the top of the document, show the button
        window.onscroll = function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                toTopButton.classList.remove("hidden");
            } else {
                toTopButton.classList.add("hidden");
            }
        }

        // When the user clicks on the button, smoothy scroll to the top of the document
        function goToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share-buttons.jquery.js') }}" defer></script>
</html>
