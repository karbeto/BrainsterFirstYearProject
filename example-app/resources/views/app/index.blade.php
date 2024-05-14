@extends('layouts.main')

@section('title', 'Brainster Party')

@section('content')
 <!--Ovde ke e navigation menu koj ke go pram so tailwind pa posle mojte da go smenite linkojte gi ostavam otvoreni za da mojte da gi povrzite so login i register-->
 <div id="navigation_menu" class="flex flex-col items-center  md:flex-row md:items-center md:justify-around m-5 md:m-10">
    <div id="logo" class="mb-4 md:mb-0">
        <h1 class="text-2xl text-white"><b>BRAINSTER</b> LEARN</h1>
    </div>
    <div id="loggin_register_buttons" class="flex flex-wrap gap-4">
        <a href="#" class="bg-purple-500 text-white px-5 py-2 rounded-xl">Log In</a>
        <a href="#" class="border border-purple-500 text-purple-500 px-5 py-2 rounded-xl">Register</a>
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


@endsection
