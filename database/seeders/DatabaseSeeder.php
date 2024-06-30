<?php

namespace Database\Seeders;

use App\Models\Attribute_items;
use App\Models\Attributes;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name"=> "Donald",
            "email"=> "admin@gmail.com",
            "password"=> bcrypt("123456"),
        ]);

        Attributes::create([
            'id'    =>'1',
            'name'  =>'Size',
        ]);

        Attribute_items::create([
            'attribute_id' =>'1',
            'name'        =>'M',
        ]);
        Attribute_items::create([
            'attribute_id' =>'1',
            'name'        =>'XL',
        ]);
        Attribute_items::create([
            'attribute_id' =>'1',
            'name'        =>'XXL',
        ]);

        Attributes::create([
            'id'    =>'2',
            'name'  =>'Liter',
        ]);


        Attribute_items::create([
            'attribute_id' =>'2',
            'name' =>'1 Ltr',
        ]);
        Attribute_items::create([
            'attribute_id' =>'2',
            'name' =>'2 Ltr',
        ]);
        Attribute_items::create([
            'attribute_id' =>'2',
            'name' =>'3 Ltr',
        ]);
    }
}
