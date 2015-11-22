<?php

namespace App\Providers;

use App\Comment;
use App\Feedback;
use App\Jobs\SentenceProcessing;
use App\Sentence;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;

class EventServiceProvider extends ServiceProvider
{
    use DispatchesJobs;

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Feedback::created(function ($item) {
            Cache::tags('feedbacks')->flush();
            $this->dispatch((new SentenceProcessing($item)));
        });

        Feedback::updated(function ($item) {
            Cache::tags('feedbacks')->flush();
        });

        Feedback::deleted(function ($item) {
            Cache::tags('feedbacks')->flush();
        });

        Comment::saved(function ($item) {
            Cache::tags('comments')->flush();
        });

        Comment::saved(function ($item) {
            Cache::tags('comments')->flush();
        });

        Sentence::saved(function ($item) {
            if ( $item->feedback ) {
                $item->feedback->calculateProbabilities();
            }
        });
    }
}
