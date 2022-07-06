<?php

namespace App\Jobs;

use App\Models\Bulletin\Bulletin;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

class BulletinCreated implements ShouldQueue
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

            Bulletin::create([
                'id' => $this->data['bulletin']['id'],
                'user_id' => $this->data['bulletin']['user_id'],
                'title' => $this->data['bulletin']['title'],
                'description' => $this->data['bulletin']['description']
            ]);

            $user = User::where('id', $this->data['user']['id'])->first();
            if ($user == null) {
                User::create([
                    'id' => $this->data['user']['id'],
                    'name' => $this->data['user']['name'],
                ]);
            }
        });
    }
}
