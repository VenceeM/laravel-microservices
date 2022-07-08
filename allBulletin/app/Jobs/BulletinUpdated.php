<?php

namespace App\Jobs;

use App\Models\Bulletin\Bulletin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class BulletinUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        DB::transaction(function () {
            Bulletin::updateOrCreate(
                [
                    'id' => $this->data['id']
                ],
                [
                    'user_id' => $this->data['user_id'],
                    'title' => $this->data['title'],
                    'description' => $this->data['description']
                ]
            );
        });
    }
}
