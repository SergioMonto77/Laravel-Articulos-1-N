<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

            <div class="mt-4 w-5/6 h-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3"> {{-- lo hago responsive=> voy a a meter 1 columna de grid para cualquier pantalla PERO si la pantalla es mediana 2 columnas y si es grande 3 col --}}

                @foreach ($articles as $item)
                    <div class="rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="{{Storage::url($item->imagen)}}" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{$item->nombre}}</div>
                            <p class="text-gray-700 text-base">{{$item->descripcion}}</p>
                            <p class="mt-3 text-gray-700 text-base"><b>{{$item->user->email}}</b></p>
                        </div>
                        <div class="px-9 pt-4 pb-2 ">
                            <a href="{{route('articles.showNoAuth', $item)}}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                <i class="fa-regular fa-eye mr-2"></i> Mirar
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="mt-2">
                    {{$articles->links()}}
                </div>
            </div>
        
    </div>
</body>

</html>
