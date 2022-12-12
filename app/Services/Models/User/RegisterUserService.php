<?php

namespace App\Services\Models\User;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class RegisterUserService extends BaseService
{
    protected $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function run() {
        $this->data['password'] = Hash::make($this->data['password']);
        $user = new User($this->data);
        if($user->save()) {
            return $user->refresh();
        }
        try {} catch (\Throwable $th) {
            report($th);
        }
        return false;
    }
}