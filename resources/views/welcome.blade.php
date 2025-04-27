<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TripCount || An Accounts Software for Agencys</title>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')

    <!-- Styles -->
    {{-- <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}
        </style> --}}
    @include('layouts.head')

    <style>
        /* Add the following styles for the sticky navbar with a white background */
        .sticky {
            transition: background-color 0.3s ease;
        }

        .sticky.scrolled {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="antialiased">
    @if (Route::has('login'))
        <div>
            <div
                class="sticky py-4 px-auto flex justify-between bg-white top-0 z-50 w-[95%] mx-auto md:w-[75%] items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 ">Dashboard</a>
                @else
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                    <div class="">
                        <a href="{{ route('login') }}"
                            class=" text-gray-600 hover:text-gray-100 dark:text-gray-400 hover:no-underline hover:bg-[#00959F] dark:hover:text-white border-2 border-[#00959F] duration-300 font-semibold py-2 rounded-md px-5">Log
                            in</a>
                        {{-- <a class=" text-gray-600 hover:text-gray-100 dark:text-gray-400 hover:no-underline hover:bg-[#00959F] dark:hover:text-white border-2 border-[#00959F] duration-300 font-semibold py-2 rounded-md px-5" href="{{ route('admin.login') }}">Admin Panel</a> --}}
                        {{-- <a href="{{ route('emp_login') }}" class=" text-gray-600 hover:text-gray-100 dark:text-gray-400 hover:no-underline hover:bg-[#00959F] dark:hover:text-white border-2 border-[#00959F] duration-300 font-semibold py-2 rounded-md px-5">Employee Login</a> --}}

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold py-2 rounded-md px-5 hover:text-gray-900 dark:text-gray-400 hover:no-underline dark:hover:text-white bg-[#00959F] text-white border-2 hover:bg-white hover:border-2 border-[#00959F] duration-300">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    @endif

    <div
        class="hero bg-dots-darker bg-center dark:bg-dots-darker dark:bg-gray-900 selection:bg-red-500 selection:text-white bg-[#00959F]">
        <div
            class="min-h-[80vh] md:gap-x-14 sm:flex md:justify-between items-center w-[95%] mx-auto md:w-[75%] md:items-center">
            <div class="md:w-[48%] w-[100%] md:py-0 py-8 md:text-start text-center">
                <h2 class='font-extrabold text-white md:text-5xl text-3xl'>Best Accounting Software Travel Agency in
                    Bangladesh</h2>
                <p class="font-semibold mt-3 md:text-xl text-lg text-gray-300">Introducing simple and easy to use
                    accounting software specially designed for travel agencies</p>
                <button
                    class="border-2 border-gray-300 text-gray-300 py-2 px-5 hover:bg-gray-300 duration-300 hover:text-gray-900 font-semibold text-lg mt-5 rounded-lg">Contact</button>
            </div>
            <div class=" md:w-[48%] w-[100%] flex items-center justify-center animate__animated animate__bounce">
                <img src={{ url('/image/bg-1.png') }} alt="banner" class="md:w-[60%] md:h-[60%] w-[60%] h-[60%] " />
            </div>
        </div>
    </div>
    <div class="py-10 md:w-[75%] mx-auto">
        <h2 class="text-center font-bold text-4xl text-[#00959F]">Our Special Features</h2>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 mx-7 md:mx-0 justify-center gap-5 py-8">
            <div
                class="bg-white shadow-2xl p-3 flex items-center flex-col gap-2 text-xl text-gray-600 font-semibold justify-center py-3 min-h-[200px] rounded-lg">
                <div><i class="fa text-3xl text-[#4d5250] bg-[#a6ebd6] p-3 rounded-full fa-regular fa-cloud"></i></div>
                <h2 class="text-xl text-black font-bold">Cloud Based ERP</h2>
                <p class="text-[18px] text-center text-gray-400">Cloud Based ERP system that can be used anywhere</p>
            </div>
            <div
                class="bg-white shadow-2xl p-3 flex items-center flex-col gap-2 text-xl text-gray-600 font-semibold justify-center py-3 min-h-[200px] rounded-lg">
                <div><i class="fa text-3xl text-[#4d5250] bg-[#a6ebd6] p-3 rounded-full fa-regular fa-user-plus"></i>
                </div>
                <h2 class="text-xl text-black font-bold">Easy To Use</h2>
                <p class="text-[18px] text-center text-gray-400">Easy to use even for the newbies in accounts</p>
            </div>
            <div
                class="bg-white shadow-2xl p-3 flex items-center flex-col gap-2 text-xl text-gray-600 font-semibold justify-center py-3 min-h-[200px] rounded-lg">
                <div><i class="fa text-3xl text-[#4d5250] bg-[#a6ebd6] rounded-full p-3 fa-user-plus"></i></div>

                <h2 class="text-xl text-black font-bold">Multi Branch</h2>
                <p class="text-[18px] text-center text-gray-400">Easy to manage multiple branches in single admin</p>
            </div>

        </div>
    </div>
    <section class="h-[80vh] relative">
        <div class="bg-[#00959F] h-[50%] py-[70px]">
            <h2 class="text-[#eca706] text-2xl text-center">
                Plans & Pricing
            </h2>
            <h3 class="text-white text-3xl md:text-5xl font-bold text-center pt-4">
                Check Our Valuable Price
            </h3>
        </div>
        <div
            class="w-[90%] xl:w-[50%] h-[80%] xl:h-[55%] absolute xl:bottom-[140px] xl:right-[40%] xl:left-[24%] py-7 bottom-[100px] md:bottom-[170px] right-[50%] top-[23%] left-[5%] md:left-[29%] ">
            <div class="h-full shadow-2xl bg-white rounded-xl overflow-hidden flex md:flex-row flex-col">
                <div class="bg-gray-800 xl:text-lg text-md h-[100%] flex justify-center flex-col px-6 w-[50%]">
                    <ul class="list-none ">
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                    strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Admin Login</span>
                        </li>
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                    strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Accountant Login</span>
                        </li>
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                    strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Unlimited Ticketing Stuff Login</span>
                        </li>
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                    strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Stuff Training</span>
                        </li>
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                    strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Technical Support</span>
                        </li>
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round" strokeLinejoin="round"
                                    strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Call back Support</span>
                        </li>
                        <li class="text-white py-1 flex gap-3 items-center">
                            <span
                                class="w-4 h-4 xl:w-4 xl:h-4 inline-flex items-center justify-center bg-white text-gray-900 rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" strokeLinecap="round"
                                    strokeLinejoin="round" strokeWidth="2.5" class="w-3 h-3 xl:h-3 xl:w-3"
                                    viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                            </span>
                            <span>Paid Virtual Accountant Service</span>
                        </li>
                        <!-- Add other list items here -->
                    </ul>
                </div>
                <div class="flex justify-center items-center text-center flex-col gap-8 w-[50%]">
                    <div class="w-full">
                        <p class="xl:text-2xl text-lg font-semibold">Initial Setup Fee</p>
                        <span class="xl:text-5xl font-bold text-xl text-red-500">
                            ৳ 10,000
                        </span>
                        <br />
                        {{-- <span class="text-3xl font-semibold  text-green-800">
                                Free
                            </span> --}}
                        <br />
                    </div>
                    <div class="w-full">
                        <p class="xl:text-2xl text-lg font-semibold">Monthly Service Charge</p>
                        <span class="xl:text-5xl text-3xl font-bold">
                            ৳1000
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="bg-gray-200 py-10">
        <div class="max-w-[85%] mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-center mb-8">
                Featured Solutions of Travel Agency Accounting Software
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <!-- Feature 1 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/invoice.png" alt="Track Cash Flows" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Ticket Invoice</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/nomad-visa.png" alt="Expense Management" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Visa Invoice</p>
                </div>
                <!-- Feature 3 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/takeover.png" alt="Multi-Payment Support" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Receive</p>
                </div>
                <!-- Feature 4 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/payment-method.png" alt="Accounting Solutions" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Payment</p>
                </div>
                <!-- Feature 5 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/ledger.png" alt="Loyalty Discounts" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">General ledger</p>
                </div>
                <!-- Feature 6 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/reminder.png" alt="Mobile Access" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Due Remainder</p>
                </div>
                <!-- Feature 7 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/team.png" alt="Customer Management" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Stuff Report</p>
                </div>
                <!-- Feature 8 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/expense.png" alt="Reporting And Analytics" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Expanditure</p>
                </div>
                <!-- Feature 9 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/consultant.png" alt="User Roles And Permissions" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">User Roles And Permissions</p>
                </div>
                <!-- Feature 10 -->
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/slip.png" alt="Data Backup" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Invoice Print</p>
                </div>
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/market-share.png" alt="Data Backup" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Sales Analisys Report</p>
                </div>
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/bar-graph.png" alt="Data Backup" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Profit / Loss Statement</p>
                </div>
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/business.png" alt="Data Backup" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Sales Report</p>
                </div>
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/transaction.png" alt="Data Backup" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Refund</p>
                </div>
                <div class="text-center bg-white p-4 rounded-md">
                    <img src="./image/justice-scale.png" alt="Data Backup" class="mx-auto mb-1 w-16 h-16">
                    <p class="text-lg font-semibold">Trial Balance</p>
                </div>
                
            </div>
        </div>
    </div>
    <div class="bg-gray-50 p-5 md:px-10">
        <h2 class="text-center font-bold text-4xl text-[#101111]">Products Belongs to Us</h2>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 mx-7 md:mx-0 justify-center gap-5 py-8">
            <a href="https://ksavisaform.com/" target="_blank"
                class="bg-white shadow-2xl p-3 flex items-center flex-col gap-2 text-xl text-gray-600 font-semibold justify-center py-3 min-h-[200px] rounded-lg">
                <div><i class="fa text-3xl text-[#4d5250] bg-[#a6ebd6] p-3 rounded-full fa-regular fa-cloud"></i></div>
                <h2 class="text-xl text-black font-bold">KSA Visa Form</h2>
                <p class="text-[18px] text-center text-gray-400">Get Ready KSA 4 Page Embassy Files Automatic </p>
            </a>
            <a href="https://rampsoft.vercel.app/" target="_blank"
                class="bg-white shadow-2xl p-3 flex items-center flex-col gap-2 text-xl text-gray-600 font-semibold justify-center py-3 min-h-[200px] rounded-lg">
                <div><i class="fa text-3xl text-[#4d5250] bg-[#a6ebd6] p-3 rounded-full fa-regular fa-user-plus"></i>
                </div>
                <h2 class="text-xl text-black font-bold">BMET File Solution</h2>
                <p class="text-[18px] text-center text-gray-400">Easy to get ready Manpower Files for your Agency</p>
            </a>
            <a href="https://www.hikmaint.com/" target="_blank"
                class="bg-white shadow-2xl p-3 flex items-center flex-col gap-2 text-xl text-gray-600 font-semibold justify-center py-3 min-h-[200px] rounded-lg">
                <div><i class="fa text-3xl text-[#4d5250] bg-[#a6ebd6] rounded-full p-3 fa-user-plus"></i></div>

                <h2 class="text-xl text-black font-bold">Agency Websites</h2>
                <p class="text-[18px] text-center text-gray-400">Any Type of Websites for your Business</p>
            </a>

        </div>
    </div>
    <div class="bg-[#00949E]">
        <section class="mb-2 lg:w-[85%] w-[95%] mx-auto min-h-[30vh] py-7  gap-5">
            <div class="">
                <div class='flex flex-col gap-3'>
                    <h2 class="text-white font-bold text-2xl">Quick Support</h2>
                    <h3 class="text-white font-bold text-4xl">Get In Touch Today!</h3>
                    <p class="text-gray-100 font-semibold text-lg">Proactively deliver seamless core competencies with
                        scalable.Compleately fabricate transparent paradigns.
                    </p>
                </div>
                <div class="grid grid-cols-3 justify-between p-4 ">
                    <div class="flex flex-col gap-y-2">
                        <button
                            class="p-2 bg-[#e9a3e3] flex items-center justify-center rounded-full w-[70px] h-[70px] text-2xl font-bold "><svg
                                xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                class="bi bi-chat-dots" viewBox="0 0 16 16">
                                <path
                                    d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                <path
                                    d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                            </svg></button>
                        <h3 class="text-white font-bold text-2xl ">About Us</h3>
                        <p class="font-semibold text-lg text-white w-[400px]">TripCount is a leading business
                            solution providing accounting package for travel agency. websites and web applications CRMS
                            ets.</p>

                    </div>
                    <div class="flex flex-col gap-y-2">
                        <button
                            class="p-2 flex items-center justify-center bg-[#88c5f7] rounded-full w-[70px] h-[70px] text-2xl font-bold "><svg
                                xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                class="bi bi-telephone" viewBox="0 0 16 16">
                                <path
                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                            </svg></button>
                        <h3 class="text-white font-bold text-2xl ">Call Us</h3>
                        <p class="font-semibold text-lg text-white">Questions about our product or pricing?<br />
                            Call for support</p>
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-xl text-white ">+88 01812215760</span>
                            <span class="font-bold text-xl text-white">+88 01776105863</span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2">
                        <button
                            class="p-2 bg-[#ecb8a0] flex items-center justify-center rounded-full w-[70px] h-[70px] text-2xl font-bold "><svg
                                xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                class="bi bi-geo-alt" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg></button>
                        <h3 class="text-white font-bold text-2xl ">Address</h3>
                        <p class="font-semibold text-lg text-white">291, Jomidar Palace, Inner circular road,
                            Motijheel, Lift-7 Dhaka-100</p>
                        <span class="font-semibold text-lg text-white">contact.sallusoft@gmail.com</span>

                    </div>
                </div>
            </div>

        </section>
    </div>
    <footer class="p-5 flex justify-center items-center">
        <div class="font-bold text-xl text-gray-500">Copyright © 2024 All rights reserved | SalluSoft</div>

    </footer>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('slider');
    const slides = slider.children;
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    let index = 0;

    function showSlide(i) {
        index = (i + slides.length) % slides.length;
        slider.style.transform = `translateX(${-index * 100}%)`;
    }

    // Event listeners for the buttons
    prevButton.addEventListener('click', () => showSlide(index - 1));
    nextButton.addEventListener('click', () => showSlide(index + 1));

    // Automatic slide every 2 seconds
    setInterval(() => {
        showSlide(index + 1);
    }, 2000); // 2000ms = 2 seconds
});
    </script>
</body>

</html>
