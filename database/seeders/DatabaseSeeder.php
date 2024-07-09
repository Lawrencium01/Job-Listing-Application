<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(4)->create();

        $user = User::factory()->create([
            'name' => 'Law King',
            'email' => 'law@email.com',
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        /*
        Listing::create([
            'title' => 'Laravel Senior Developer',
            'tags' => 'laravel, javascript',
            'company' => 'Acme corp',
            'location' => 'Boston, MA',
            'email' => 'email1@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia aspernatur, fugit mollitia cupiditate ipsam hic ad architecto asperiores blanditiis dignissimos ducimus nemo porro aliquid doloremque placeat sit iusto eum qui!'
        ]);

        Listing::create([
            'title' => 'Full Stack Engineer',
            'tags' => 'laravel, backend,api',
            'company' => 'Stark Industries',
            'location' => 'New York, NY',
            'email' => 'email2@email.com',
            'website' => 'https://www.stark.com',
            'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officia aspernatur, fugit mollitia cupiditate ipsam hic ad architecto asperiores blanditiis dignissimos ducimus nemo porro aliquid doloremque placeat sit iusto eum qui!',
        ]);
        */
    }
}
