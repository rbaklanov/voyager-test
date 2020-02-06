<?php

namespace App\Domain\Billing\DataTransferObjects;

use Illuminate\Http\Request;


class BillingData
{
    public $name;
    public $email;
    public $birth_date;

    public function __construct($data)
    {
        $this->name = $data['name'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->birth_date = $data['birth_date'] ?? null;
    }
}

class BillingClassFactory
{
    public static function fromRequest(Request $request): BillingData
    {
        return new BillingData([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'birth_date' => $request->get('birth_date')
        ]);
    }
}
