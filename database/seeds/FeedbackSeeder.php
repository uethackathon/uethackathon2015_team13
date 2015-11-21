<?php

use App\Feedback;
use App\Status;
use App\Visibility;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Feedback::class, 2)->create()->each(function ($item) {
        	$visibility = Visibility::actual()->orderByRaw("RAND()")->first();
    		$status = Status::actual()->orderByRaw("RAND()")->first();
        	$item->visibility()->associate($visibility);
        	$item->status()->associate($status);
        	$item->save();
        });
    }
}
