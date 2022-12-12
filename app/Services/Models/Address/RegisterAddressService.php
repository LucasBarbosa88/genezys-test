<?php

namespace App\Services\Models\Address;

use App\Models\Address;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class RegisterAddressService extends BaseService
{
    protected $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function run() {
        $address = new Address($this->data);
        if($address->save()) {
            return $address->refresh();
        }
        try {} catch (\Throwable $th) {
            report($th);
        }
        return false;
    }
}