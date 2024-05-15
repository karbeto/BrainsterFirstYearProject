@extends('layouts.main')

@section('title', 'Add Event')

@section('content')
<section class="flex items-center justify-center min-h-screen px-8">
    <form method="POST" action="{{ route('store.event') }}" class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-7 animated" style="background-color: #101010;">
        @csrf
        <div id="create-event">
            <h1 class="font-bold text-3xl mb-4 label-color">Here you can create your event.</h1>
            <div class="mb-4">
                <label for="event-name" class="block field-color font-medium mb-2">Name of Event:</label>
                <input type="text" id="event-name" placeholder="Your Event Title" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="title">
            </div>
            <div class="flex flex-col md:flex-row gap-6 mb-4">
                <div class="w-full">
                    <label for="start-date" class="block field-color font-medium mb-2 md:text-left">Start Date:</label>
                    <input type="datetime-local" id="start-date" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="from">
                </div>
                <div class="w-full">
                    <label for="end-date" class="block field-color font-medium mb-2 md:text-left">End Date:</label>
                    <input type="datetime-local" id="end-date" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="to">
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-6 mb-4">
                <div class="w-full">
                    <label for="ticket-price" class="block field-color font-medium mb-2">Ticket Price:</label>
                    <input type="number" id="ticket-price" placeholder="Enter price" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="ticket_price">
                </div>
                <div class="w-full">
                    <label for="ticket-url" class="block field-color font-medium mb-2">Ticket URL:</label>
                    <input type="url" id="ticket-url" placeholder="Enter URL" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="ticket_url">
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-6 mb-4">
                <div class="w-full">
                    <label for="comment" class="block field-color font-medium mb-2">Comment:</label>
                    <textarea id="comment" placeholder="Enter your comment" class="w-full h-10 resize-none overflow-hidden rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="comment"></textarea>
                </div>
                <div class="w-full">
                    <label for="contact" class="block field-color font-medium mb-2">Contact:</label>
                    <input type="text" id="contact" placeholder="Enter contact information" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="contact">
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-6 mb-4">
                <div class="w-full">
                    <label for="location" class="block field-color font-medium mb-2">Location:</label>
                    <select id="location" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="location">
                        <option value="" disabled selected>Select location</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                    <label for="type" class="block field-color font-medium mb-2">Type:</label>
                    <select id="type" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="type">
                        <option value="" disabled selected>Select type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-6">
                <label for="image-url" class="block field-color font-medium mb-2">Image URL:</label>
                <input type="url" id="image-url" placeholder="Enter your image URL" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2 px-3 text-sm" name="image_url">
            </div>
            <button type="submit" class="w-full text-[#a0aec0] font-semibold py-3 rounded-lg bg-[#8448e5] hover:bg-[#8448e5] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 ease-in-out transform hover:scale-105">Create Event</button>
        </div>
    </form>
</section>
@endsection
