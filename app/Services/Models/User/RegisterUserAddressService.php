<?php

namespace App\Services\Models\User;

use App\Models\UserAddress;
use App\Services\BaseService;

class RegisterUserAddressService extends BaseService
{
    protected $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function run() {
        $userAddress = new UserAddress($this->data);
        if($userAddress->save()) {
            return $userAddress->refresh();
        }
        try {} catch (\Throwable $th) {
            report($th);
        }
        return false;
    }
}