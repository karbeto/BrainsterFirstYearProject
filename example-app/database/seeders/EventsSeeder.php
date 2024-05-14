<?php

namespace Database\Seeders;

use App\Models\Events;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Events::create([
        //     'user_id' => 1,
        //     'type_id' => 1,
        //     'city_id' => 1,
        //     'title' => 'Brainster Party',
        //     'ticket_price' => 155,
        //     'ticket_url' => 'https://next.edu.mk/',
        //     'from' => '2024-12-11',
        //     'to' => '2024-12-12',
        //     'image_url' => 'https://brainster.co/wp-content/uploads/2021/07/brainster.co_-1.png',
        //     'comment' => 'amazing academy',
        //     'contact' => '070111111',
        //     'location' => 'skopje-centar',
        // ]);
        Events::create([
            'user_id' => 1,
            'type_id' => 1,
            'city_id' => 1,
            'title' => 'Tech Conference',
            'ticket_price' => 200,
            'ticket_url' => 'https://techconference.com/',
            'from' => '2024-11-20',
            'to' => '2024-11-21',
            'image_url' => 'https://brainster.co/wp-content/uploads/2021/07/brainster.co_-1.png',
            'comment' => 'Great opportunity to learn about the latest tech trends.',
            'contact' => '070222222',
            'location' => 'tech-center',
        ]);
        
        // Event 3
        Events::create([
            'user_id' => 1,
            'type_id' => 1,
            'city_id' => 5,
            'title' => 'Art Exhibition',
            'ticket_price' => 50,
            'ticket_url' => 'https://artexhibition.com/',
            'from' => '2024-10-15',
            'to' => '2024-10-17',
            'image_url' => 'https://brainster.co/wp-content/uploads/2021/07/brainster.co_-1.png',
            'comment' => 'Discover amazing artworks by talented artists.',
            'contact' => '070333333',
            'location' => 'art-gallery',
        ]);
        
        // Event 4
        Events::create([
            'user_id' => 1,
            'type_id' => 1,
            'city_id' => 8,
            'title' => 'Music Festival',
            'ticket_price' => 100,
            'ticket_url' => 'https://musicfestival.com/',
            'from' => '2025-05-01',
            'to' => '2025-05-03',
            'image_url' => 'https://brainster.co/wp-content/uploads/2021/07/brainster.co_-1.png',
            'comment' => 'Experience unforgettable performances by top artists.',
            'contact' => '070444444',
            'location' => 'outdoor-venue',
        ]);
        
        // Event 5
        Events::create([
            'user_id' => 1,
            'type_id' => 1,
            'city_id' => 12,
            'title' => 'Startup Pitch Competition',
            'ticket_price' => 50,
            'ticket_url' => 'https://startupcompetition.com/',
            'from' => '2024-09-10',
            'to' => '2024-09-11',
            'image_url' => 'https://brainster.co/wp-content/uploads/2021/07/brainster.co_-1.png',
            'comment' => 'Showcase your startup and win exciting prizes.',
            'contact' => '070555555',
            'location' => 'startup-hub',
        ]);

    }
}
