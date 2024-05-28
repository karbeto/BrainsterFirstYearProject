<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Event;
use App\Models\Type;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = null;
        $types = Type::all();
        $cities = City::all();
        return view("app.index" , compact('events', 'types', 'cities'));
    }

    public function create(){
        $cities = City::all();
        $types = Type::all();
 
        return view("app.create-event", compact('cities', 'types'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start-date' => 'required|date',
            'end-date' => 'required|date|after_or_equal:start-date',
            'ticket_price' => 'nullable|string',
            'ticket_url' => 'nullable|url',
            'comment' => 'required|string',
            'contact' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|string',
            'image_url' => 'required|url',
        ]);

        if(session()->has("id")) {
            $event = new Event();
            $event->users_id = session()->get("id"); 
            $event->type_id = $request->type;
            $event->city_id = $request->location;
            $event->title = $validatedData['title'];
            $event->ticket_price = $validatedData['ticket_price'];
            $event->ticket_url = $validatedData['ticket_url'];
            $event->from = $validatedData['start-date'];
            $event->to = $validatedData['end-date'];
            $event->image_url = $validatedData['image_url'];
            $event->comment = $validatedData['comment'];
            $event->contact = $validatedData['contact'];
            $event->location = $validatedData['location'];
            $event->save();
            return redirect()->route('view-events')->with('success', 'Event created successfully.');
        } else {
            return redirect()->back()->with("error" , "Something went wrong");
        }
    }

    public function all() {
        $events = Event::with('users', 'type', 'city')->get();
        return response()->json($events);
    }

    public function dashboard() {
        $userId = session()->get("id");
        $events = Event::where('users_id', $userId)->get();
        return view('app.dashboard', compact('events'));
    }

    public function edit($id) {
        $event = Event::findOrFail($id);
        $cities = City::all();
        $types = Type::all();
        return view('app.edit-event', compact('event', 'cities', 'types'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start-date' => 'required|date',
            'end-date' => 'required|date|after_or_equal:start-date',
            'ticket_price' => 'nullable|string',
            'ticket_url' => 'nullable|url',
            'comment' => 'required|string',
            'contact' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|string',
            'image_url' => 'required|url',
        ]);

        $event = Event::findOrFail($id);
        $event->type_id = $request->type;
        $event->city_id = $request->location;
        $event->title = $validatedData['title'];
        $event->ticket_price = $validatedData['ticket_price'];
        $event->ticket_url = $validatedData['ticket_url'];
        $event->from = $validatedData['start-date'];
        $event->to = $validatedData['end-date'];
        $event->image_url = $validatedData['image_url'];
        $event->comment = $validatedData['comment'];
        $event->contact = $validatedData['contact'];
        $event->location = $validatedData['location'];
        $event->save();
        return redirect()->route('dashboard')->with('success', 'Event updated successfully.');
    }

    public function destroy($id) {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('dashboard')->with('success', 'Event deleted successfully.');
    }
}
