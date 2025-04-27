<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TripCount || An Accounts Software for Agencys') }}</title>
    @vite('resources/css/app.css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.head')
    <style>
        @layer utilities {
            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }
            .no-scrollbar {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }
        }
    </style>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
</head>

<body class="bg-[#F0EFEF] antialiased">
    @include('layouts.navigation')

    <!-- Barra lateral -->
    <div class="flex">
    @include('layouts.sidebar')

    <div class="w-full p-5">

        {{ $slot }}
    </div>
  </div>
  {{-- lg:ml-64 lg:pl-4 lg:flex lg:flex-col lg:w-75% mt-5 --}}
    <!-- Script  -->
    <script>
        // Agregar lógica para mostrar/ocultar la navegación lateral al hacer clic en el ícono de menú
        const menuBtn = document.getElementById('menuBtn');
        const sideNav = document.getElementById('sideNav');

        menuBtn.addEventListener('click', () => {
            sideNav.classList.toggle('hidden');
        });
    </script>
   
    <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    important: true,
    theme: {
      extend: {
        colors: {
          clifford: "#da373d",
        },
        
      },
    },
  }
  
 
</script>

</body>

</html>
