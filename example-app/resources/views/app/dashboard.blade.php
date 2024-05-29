@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <body class="bg-gray-900 text-white font-sans">
        <div class="container mx-auto px-4 py-8">
            <!-- Navbar -->
            <nav class="flex flex-col lg:flex-row justify-between items-center mb-8">
    <div class="mb-4 lg:mb-0 lg:mr-4">
        <p href="#" class="text-3xl font-bold text-purple-500">Dashboard</p>
    </div>
    <div class="flex items-center">
        @if(session()->has('email'))
            <a href="{{ route('create.event') }}" class="px-4 py-2 bg-purple-600 text-white rounded-full mr-4 hover:bg-purple-700">Create Event</a>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-transparent border border-purple-600 text-purple-600 rounded-full hover:bg-purple-600 hover:text-white">Log Out</button>
            </form>
        @else
            <a href='{{ route("auth.login") }}' class="px-4 py-2 bg-purple-600 text-white rounded-full mr-4 hover:bg-purple-700">Log In</a>
            <a href='{{ route("auth.register") }}' class="px-4 py-2 bg-transparent border border-purple-600 text-purple-600 rounded-full hover:bg-purple-600 hover:text-white">Register</a>
        @endif
    </div>
</nav>


            <!-- Your Events Section -->
            <section class="mb-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($events as $event)
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transition duration-300 transform hover:scale-105">
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-t-lg">
                        <div class="px-6 py-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                            <p class="text-gray-400 mb-4">{{ $event->description }}</p>
                            <p class="text-gray-400">Start Date: {{ $event->from }}</p>
                            <p class="text-gray-400">End Date: {{ $event->to }}</p>
                        </div>
                        <div class="px-6 py-4 flex justify-end">
                            <a href="{{ route('edit.event', $event->id) }}" class="text-blue-400 hover:text-blue-300 mr-2">Edit</a>
                            <!-- Delete Button with Modal -->
                            <button type="button" onclick="openDeleteModal(<?php echo $event->id?>)" class="text-red-400 hover:text-red-300">Delete</button>
                            <!-- Modal -->
                            <div id="deleteModal_{{ $event->id }}" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                    </div>
                                    <!-- This element is to trick the browser into centering the modal contents. -->
                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                    <!-- Heroicon name: outline/exclamation -->
                                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.77-1.24 2.77-2.77V10.77c0-1.54-1.24-2.77-2.77-2.77H5.062c-1.54 0-2.77 1.24-2.77 2.77v9.46c0 1.54 1.24 2.77 2.77 2.77zM15 9a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </div>
                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                        Delete Event
                                                    </h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            Are you sure you want to delete this event? This action cannot be undone.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <form action="{{ route('delete.event', $event->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                            <button type="button" onclick="closeDeleteModal(<?php echo $event->id ?>)" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
        <script>
            //DashboardModal
function openDeleteModal(eventId) {
    const modal = document.getElementById('deleteModal_' + eventId);
    modal.classList.remove('hidden');
}


function closeDeleteModal(eventId) {
    const modal = document.getElementById('deleteModal_' + eventId);
    modal.classList.add('hidden');
}



        </script>    </body>
@endsection