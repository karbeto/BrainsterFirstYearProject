@extends('layouts.main')

@section('title', 'Brainster Party')

@section('content')
 <!--Ovde ke e navigation menu koj ke go pram so tailwind pa posle mojte da go smenite linkojte gi ostavam otvoreni za da mojte da gi povrzite so login i register-->
 <div class="flex flex-col items-center self-center px-5 py-10 w-full">
    <div class="flex flex-col md:flex-row gap-7 px-10 justify-between w-full text-lg leading-8 text-white max-w-[1520px] max-md:flex-wrap max-md:max-w-full">
        <div class="md:self-center">
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/6b051c7484d9d0153007283d96798e85af413ba0ce5ae7beead6b6617ba9dd44?apiKey=7925220406f349788b6d4a92c76ee210&" alt="Logo" class="shrink-0 my-auto w-48 md:w-60 max-w-full aspect-[7.69]" />
        </div>
        <div class="flex gap-8 justify-between items-center max-md:flex-wrap md:self-center">
            <a href="#" class="px-10 py-2 bg-violet-600 rounded-xl max-md:px-5">Log In</a>
            <a href="#" class="px-10 py-2 whitespace-nowrap rounded-xl border border-violet-600 border-solid max-md:px-5">Register</a>
            <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/8dafc9d6c564e37439e71d2f82259a6b72fdfaff1806f391b9b60d0d9ed230a1?apiKey=7925220406f349788b6d4a92c76ee210&" alt="User icon" class="shrink-0 my-auto aspect-square w-8 md:w-[35px]" />
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


@endsection
