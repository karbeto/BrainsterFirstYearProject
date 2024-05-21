@extends('layouts.main')

@section('title', 'Brainster Party')

@section('content')
<!--Ovde ke e navigation menu koj ke go pram so tailwind pa posle mojte da go smenite linkojte gi ostavam otvoreni za da mojte da gi povrzite so login i register-->

<body class="bg-gray-900 text-white">
    <div class="flex flex-col items-center self-center px-5 py-10 w-full">
        <!-- Desktop Navbar -->
        <div class="hidden md:flex md:flex-row gap-7 px-10 justify-between w-full text-lg leading-8 text-white max-w-[1520px]">
            <div class="self-center">
                <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/6b051c7484d9d0153007283d96798e85af413ba0ce5ae7beead6b6617ba9dd44?apiKey=7925220406f349788b6d4a92c76ee210&" alt="Logo" class="shrink-0 my-auto w-48 md:w-60 max-w-full aspect-[7.69]" />
            </div>
            <div class="flex gap-8 justify-between items-center">
                <a href="#" class="px-10 py-2 bg-custom-purple rounded-xl">Log In</a>
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
                <a href="#" class="block px-4 py-2 bg-custom-purple rounded-xl text-center">Log In</a>
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
    <div class="thumbnail mt-10"></div>
    <script src="{{ asset('js/app.js') }}"></script>
    <div id="eventsData" style="display: none;">{{ $events }}</div>
    <script>
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    <div class="flex flex-col mt-20 items-center self-center px-24 w-full">
        <div class="mt-16 flex items-center justify-center text-white">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Where are we going tonight?
                    <div class="inline-block relative">
                        <div class="-z-10 absolute -right-0 -top-10 transform">
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#df4e4e" d="M386.3 160H336c-17.7 0-32 14.3-32 32s14.3 32 32 32H464c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v51.2L414.4 97.6c-87.5-87.5-229.3-87.5-316.8 0s-87.5 229.3 0 316.8s229.3 87.5 316.8 0c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0c-62.5 62.5-163.8 62.5-226.3 0s-62.5-163.8 0-226.3s163.8-62.5 226.3 0L386.3 160z" />
                            </svg>
                        </div>
                    </div>
                </h1>
            </div>
        </div>


        <div class="flex gap-5 justify-between mt-16 mb-16 w-full text-lg leading-8 text-white max-w-[1520px] max-md:flex-wrap max-md:mt-10 max-md:max-w-full">
            <div class="flex gap-5 justify-between w-full m-auto font-medium max-md:flex-wrap">

                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-[#8448E5] hover:opacity focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">All Events <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="15" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#ffffff" d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                    </svg>
                </button>

                <div id="dropdown" class="z-10 hidden bg-[#8448E5] divide-y divide-white rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-white" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="flex items-center block px-4 py-2 text-sm text-white hover:bg-gray-100 hover:text-gray-900">All Events <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="15" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#ffffff" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                </svg></a>
                        </li>
                        @foreach($types as $type)
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-100 hover:text-gray-900">{{ $type->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>


                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown2" class="text-white bg-[#8448E5] hover:opacity focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">City <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="15" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#ffffff" d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                    </svg>
                </button>
                <!-- HERE WE ADD CITIES  -->
                <div id="dropdown2" class="z-10 hidden bg-[#8448E5] divide-y divide-white rounded-lg shadow w-44">
                    <ul class="py-2 text-sm text-white" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="flex items-center block px-4 py-2 text-sm text-white hover:bg-gray-100 hover:text-gray-900">City <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" height="20" width="15" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#ffffff" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                </svg></a>
                        </li>
                        @foreach($cities as $city)
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-100 hover:text-gray-900">{{ $city->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex">
                    <input type="checkbox" id="choose-me" class="peer hidden" />
                    <label for="choose-me" class="select-none cursor-pointer rounded-lg border-2 border-gray-200
      py-3 px-6 font-bold text-gray-200 transition-colors duration-200 ease-in-out peer-checked:bg-[#8448E5] peer-checked:border-gray-200 "> Brainster </label>
                </div>
                <div class="flex">
                    <input type="checkbox" id="choose-me2" class="peer hidden" />
                    <label for="choose-me2" class="select-none cursor-pointer rounded-lg border-2 border-gray-200
      py-3 px-6 font-bold text-gray-200 transition-colors duration-200 ease-in-out peer-checked:bg-[#8448E5] peer-checked:border-gray-200 "> MOB </label>
                </div>
                <div class="flex">
                    <input type="checkbox" id="choose-me3" class="peer hidden" />
                    <label for="choose-me3" class="select-none cursor-pointer rounded-lg border-2 border-gray-200
      py-3 px-6 font-bold text-gray-200 transition-colors duration-200 ease-in-out peer-checked:bg-[#8448E5] peer-checked:border-gray-200 "> Laboratorium </label>
                </div>
            </div>

            <form class="max-w-md mx-auto">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                </div>
            </form>

        </div>
        <div id="calendar" class="w-full text-white"></div>
    </div>
    <!-- </div> -->
    </div>
    <div class="flex flex-col items-center px-16 pt-8 pb-14 mt-32 w-full bg-black max-md:px-5 max-md:mt-10 max-md:max-w-full">
        <div class="flex flex-col items-center w-full max-w-[1678px] max-md:max-w-full">
            <div class="flex gap-5 justify-between items-center w-full max-w-[1366px] max-md:flex-wrap  max-md:max-w-full">
                <img loading="lazy" src="./images/brainster-learn-logo 2.png" alt="Logo" class="shrink-0 self-stretch my-auto w-14 bg-rose-500 rounded-full aspect-[0.78]" />
                <div class="flex flex-col items-center self-stretch">
                    <img loading="lazy" src="./images/brainster-learn-logo 2.png" alt="Logo" class="mx-9 w-72 aspect-[7.69]" />
                    <div class="flex gap-4 mt-10 w-[356px] justify-center">
                        <a href="#" target="_blank">
                            <img loading="lazy" src="./images/logos_facebook.png" alt="Facebook" class="w-1/11" />
                        </a>
                        <a href="#" target="_blank">
                            <img loading="lazy" src="./images/Group.png" alt="Instagram" class="w-1/11" />
                        </a>
                        <a href="#" target="_blank">
                            <img loading="lazy" src="./images/devicon_linkedin.png" alt="LinkedIn" class="w-1/11" />
                        </a>
                        <a href="#" target="_blank">
                            <img loading="lazy" src="./images/logos_tiktok-icon.png" alt="Tiktok" class="w-1/11" />
                        </a>
                        <a href="#" target="_blank">
                            <img loading="lazy" src="./images/logos_youtube-icon.png" alt="YouTube" class="w-1/11" />
                        </a>
                    </div>
                </div>
                <img loading="lazy" src="./images/brainster-learn-logo 2.png" class="shrink-0 self-stretch my-auto w-14 bg-rose-500 rounded-full aspect-[0.78]" />
            </div>
            <div class="shrink-0 self-stretch mt-16 h-px border border-solid bg-neutral-600 border-neutral-600 max-md:mt-10 max-md:max-w-full"></div>
            <div class="flex justify-between mt-7 w-full text-sm text-white max-w-[1518px]">
                <div>© Brainster 2024. Designed with love.</div>
                <div>
                    Do you like to read long legal texts? <a href="#" class="text-white underline">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>

    <div id="multiEventModal" class="fixed inset-0 z-50 flex justify-center items-center backdrop-blur hidden">
        <div id="mw" class=" p-8 rounded-lg w-1/5">
            <div id="multiEventModalBody"></div>
            <button id="closeMultiEventModal" class="mt-4 text-white bg-gray-800 px-4 py-2 rounded-md">Close</button>
        </div>
    </div>

    <div id="singleEventModal" class="fixed inset-0 z-50 flex justify-center items-center backdrop-blur hidden w-1/2">
        <div class="bg-[#101010] text-white rounded-lg overflow-auto">
            <div id="singleModalImageContainer"></div>
            <div id="singleModalContent" class="p-8"></div>
            <button id="closeSingleModal" class="mt-4 text-white bg-gray-800 px-4 py-2 rounded-md">Close</button>
        </div>
    </div>
    <script src="{{ asset('js/calendar.js') }}"></script>

    @endsection