<?php

namespace App\Jobs;

use App\Category;
use App\Exceptions\Handler;
use App\Feedback;
use App\Jobs\Job;
use App\Sentence;
use GuzzleHttp\Client;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SentenceProcessing extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $feedback;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'http://feedback.dev/',
            'timeout'  => 2.0,
        ]);

        $response = $client->get('sentence-processing');

        /*$response = $client->post('process', [
            'feedback' => $this->feedback->content
        ]);*/
        
        try {
            $jsonData = json_decode($response->getBody());
            $jsonData = collect($jsonData);
            $classifications = Category::classifications()->get()->keyBy('name');
            $sentences = [];
            $jsonData->each(function ($item, $key) use ($classifications, &$sentences) {
                $sentence = new Sentence([
                    "content" => $item->content,
                    "classification_id" => $classifications->get($item->classification)->id
                ]);
                array_push($sentences, $sentence);
            });
            $this->feedback->sentences()->saveMany($sentences);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
