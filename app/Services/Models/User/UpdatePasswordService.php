<?php

namespace App\Services\Models\User;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordService extends BaseService
{
    protected $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function run() {
        $user = User::find($this->data['user_id']);
        $user->password = Hash::make($this->data['password']);
        if($user->save()) {
            return $user->refresh();
        }
        try {} catch (\Throwable $th) {
            report($th);
        }
        return false;
    }
}