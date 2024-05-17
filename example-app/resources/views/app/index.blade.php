@extends('layouts.main')

@section('title', 'Brainster Party')

@section('content')
 <!--Ovde ke e navigation menu koj ke go pram so tailwind pa posle mojte da go smenite linkojte gi ostavam otvoreni za da mojte da gi povrzite so login i register-->
 <body class="bg-gray-900 text-white">
    <div class="flex flex-col items-center self-center px-5 py-10 w-full">
        <!-- Desktop Navbar -->
        <div class="hidden md:flex flex-row gap-7 px-10 justify-between w-full text-lg leading-8 text-white max-w-[1520px]">
            <div class="self-center">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/6b051c7484d9d0153007283d96798e85af413ba0ce5ae7beead6b6617ba9dd44?apiKey=7925220406f349788b6d4a92c76ee210&" alt="Logo" class="shrink-0 my-auto w-48 md:w-60 max-w-full aspect-[7.69]" />
            </div>
            <div class="flex gap-8 justify-between items-center">
                <a href="#" class="px-10 py-2 bg-violet-600 rounded-xl">Log In</a>
                <a href="#" class="px-10 py-2 whitespace-nowrap rounded-xl border border-violet-600 border-solid">Register</a>
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/8dafc9d6c564e37439e71d2f82259a6b72fdfaff1806f391b9b60d0d9ed230a1?apiKey=7925220406f349788b6d4a92c76ee210&" alt="User icon" class="shrink-0 my-auto aspect-square w-8 md:w-[35px]" />
            </div>
        </div>

        <!-- Mobile Navbar -->
        <div class=" flex  flex-col md:hidden w-full ">
            <div class="flex justify-between items-center px-5">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/6b051c7484d9d0153007283d96798e85af413ba0ce5ae7beead6b6617ba9dd44?apiKey=7925220406f349788b6d4a92c76ee210&" alt="Logo" class="shrink-0 my-auto w-40 max-w-full aspect-[7.69]" />
                <div class="hamburger" id="hamburger">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
                </div>
            </div>
            <div class="hidden flex-col gap-4 mt-10 px-5" id="mobileMenu">
                <a href="#" class="block px-4 py-2 bg-violet-600 rounded-xl text-center">Log In</a>
                <a href="#" class="block px-4 m-5 py-2 border border-violet-600 border-solid rounded-xl text-center">Register</a>
                <div class="flex justify-center">
                    <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/8dafc9d6c564e37439e71d2f82259a6b72fdfaff1806f391b9b60d0d9ed230a1?apiKey=7925220406f349788b6d4a92c76ee210&" alt="User icon" class="shrink-0 my-auto aspect-square w-10" />
                </div>
            </div>
        </div>
    </div>



<!--Here is the side bar -->
<div class="slider">
        <!-- Dynamic list of slider items -->
        <div class="list"></div>
    <!-- Dynamic thumbnails -->

    </div>
    <div class="thumbnail"></div>
    <script src="{{ asset('js/app.js') }}"></script>
    <div id="eventsData" style="display: none;">{{ $events }}</div>
    <script>
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>


@endsection
