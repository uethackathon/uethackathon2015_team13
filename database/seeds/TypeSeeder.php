<?php

use App\Category;
use App\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(["name" => Type::$visibilityName])->categories()->saveMany([
            new Category(["name" => "private"]),
            new Category(["name" => "public"])
        ]);

        Type::create(["name" => Type::$classificationName])->categories()->saveMany([
            new Category(["name" => "positive"]),
            new Category(["name" => "negative"]),
            new Category(["name" => "neutral"]),
        ]);

        Type::create(["name" => Type::$statusName])->categories()->saveMany([
            new Category(["name" => "open"]),
            new Category(["name" => "closed"]),
            new Category(["name" => "onhold"])
        ]);
    }
}
