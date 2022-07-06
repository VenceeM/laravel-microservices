<?php

namespace App\Services\Bulletin;

use App\Models\Bulletin\Bulletin;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BulletinService
{


    public $bulletinModel;
    public $userModel;

    public function __construct(Bulletin $bulletin, User $user)
    {
        $this->bulletinModel = $bulletin;
        $this->userModel = $user;
    }

    public function getBulletin()
    {

        $bulletin = DB::table('bulletins as bl')
            ->leftJoin('users as us', 'bl.user_id', '=', 'us.id')
            ->select(
                'us.*',
                'bl.*'
            )
            ->paginate(10);
        return $bulletin;
    }
}
