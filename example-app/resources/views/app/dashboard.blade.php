@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<section class="flex items-center justify-center min-h-screen px-8">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-7" style="background-color: #101010;">
        <h1 class="font-bold text-3xl mb-4 label-color">Your Events</h1>

        @if(session('success'))
            <div class="text-green-500 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($events->isEmpty())
            <p class="text-white">You have no events.</p>
        @else
            <table class="w-full text-left text-white">
                <thead>
                    <tr>
                        <th class="pb-2">Title</th>
                        <th class="pb-2">Start Date</th>
                        <th class="pb-2">End Date</th>
                        <th class="pb-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td class="py-2">{{ $event->title }}</td>
                            <td class="py-2">{{ $event->from }}</td>
                            <td class="py-2">{{ $event->to }}</td>
                            <td class="py-2">
                                <a href="{{ route('edit.event', $event->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('delete.event', $event->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>

@endsection
