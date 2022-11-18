<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as F;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                $faker = F::create('lt_LT');
                $time = Carbon::now();

                DB::table('users')->insert([
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('123'),
                    'created_at' => $time,
                    'updated_at' => $time,
                    'role'=> 10,
                   
                ]);
                DB::table('users')->insert([
                    'name' => 'Reader',
                    'email' => 'Reader@gmail.com',
                    'password' => Hash::make('123'),
                    'created_at' => $time,
                    'updated_at' => $time,
                    'role'=> 1,
                    
                ]);   
                
                
                foreach(['Classics', 'Crime', 'Fantasy', 'Horror', 'Poetry'] as $category){
                    DB::table('categories')->insert([
                        'name' => $category,
                        'created_at' => $time->addSeconds(1),
                        'updated_at' => $time,
                    ]);
                }

                foreach(['A Tale Of Two Cities', 'The Little Prince', 'Harry Potter and the Philosophers Stone', 'And Then There Were None', 'Dream Of The Red Chamber', 'The Hobbit' ] as $book){
                    DB::table('books')->insert([
                        'title' => $book,
                        'description' => $faker->text,
                        'ISBN' => rand(1000000000000,9999999999999),
                        'pages' => rand(150, 2000),
                        'category_id' => rand(1,5),
                        'created_at' => $time->addSeconds(1),
                        'updated_at' => $time,
                    ]);
                }
    }
}
