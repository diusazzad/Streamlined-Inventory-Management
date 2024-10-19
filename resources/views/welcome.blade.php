<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <style>
        .container {
            max-width: 1200px;
            width: 90%;
        }

        img {
            @apply w-10 h-10;
        }

        nav {
            @apply flex space-x-4;
        }

        a {
            @apply px-4 py-2 bg-gray-100 rounded-full;
            font-size: 16px;
            color: #1e1e1e;
            text-decoration: none;
        }

        button {
            @apply bg-blue-500 hover: bg-blue-600 text-white px-4 py-2 rounded-full;
        }

        .btn-secondary {
            @apply bg-black text-white px-4 py-2 rounded-full;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between">
            <div class="flex-shrink-0">
                <img src="{{ asset('landing/logo.svg') }}" alt="Logo" class="w-10 h-10">
            </div>

            <!-- Hamburger Menu -->
            <div class="block lg:hidden">
                <button id="menu-toggle"
                    class="flex items-center px-3 py-2 border rounded text-gray-700 border-gray-600 hover:text-gray-900 hover:border-gray-900">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0v-2zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav id="nav-links" class="hidden lg:flex space-x-4">
                <a href="#" class="px-4 py-2 bg-gray-100 rounded-full">Pricing</a>
                <a href="#" class="px-4 py-2 bg-gray-100 rounded-full">Solutions</a>
                <a href="#" class="px-4 py-2 bg-gray-100 rounded-full">Community</a>
                <a href="#" class="px-4 py-2 bg-gray-100 rounded-full">Resources</a>
                <a href="#" class="px-4 py-2 bg-gray-100 rounded-full">Contact</a>
            </nav>

            <!-- Authentication Buttons -->
            <div class="flex items-center space-x-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full">Sign in</button>
                <button class="bg-black text-white px-4 py-2 rounded-full">Register</button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden mt-4 hidden">
            <nav class="flex flex-col space-y-2">
                <a href="#" class="block px-4 py-2 bg-gray-100 rounded-full">Pricing</a>
                <a href="#" class="block px-4 py-2 bg-gray-100 rounded-full">Solutions</a>
                <a href="#" class="block px-4 py-2 bg-gray-100 rounded-full">Community</a>
                <a href="#" class="block px-4 py-2 bg-gray-100 rounded-full">Resources</a>
                <a href="#" class="block px-4 py-2 bg-gray-100 rounded-full">Contact</a>
            </nav>
        </div>

    </div>

    <div id="heroactions"
        class="bg-gray-200 h-[524px] w-full max-w-[1200px] mx-auto px-6 py-16 flex flex-col justify-center items-center gap-8">
        <div id="textcontenttitle" class="flex flex-col gap-2 text-center">
            <h1 id="title2" class="text-gray-800 text-[72px] font-inter leading-tight md:text-[64px] sm:text-[48px]">
                Title
            </h1>
            <h2 id="subtitle" class="text-gray-600 text-[32px] font-inter leading-snug md:text-[28px] sm:text-[24px]">
                Subtitle
            </h2>
        </div>

        <div id="buttongroup" class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8">
            <button id="button2"
                class="bg-gray-300 h-[40px] w-[112px] rounded-lg flex justify-center items-center p-3 hover:bg-gray-400 transition duration-200">
                <span class="text-gray-800 text-[16px] font-inter">Button</span>
            </button>

            <button id="button4"
                class="bg-gray-800 h-[40px] w-[112px] rounded-lg flex justify-center items-center p-3 hover:bg-gray-700 transition duration-200">
                <span class="text-white text-[16px] font-inter">Button</span>
            </button>
        </div>
    </div>

    <!-- JavaScript for toggling mobile menu -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>


</body>

</html>
