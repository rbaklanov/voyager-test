<?php

namespace App\Controllers;

use App\Domain\Billing\Actions\CreateBillingAction;
use App\Domain\Billing\DataTransferObjects\BillingData;
use App\Domain\Billing\DataTransferObjects\BillingClassFactory;
use App\Domain\Billing\States\Cancelled;
use Illuminate\Http\Request;
use App\Domain\Billing\States\Active;
use App\Domain\Billing\States\Pending;
use App\Domain\Billing\Models\Billing;

class Billings
{
    public function state(Request $request)
    {
        $data = BillingClassFactory::fromRequest($request);

        echo "{$data->name}" . PHP_EOL . "{$data->email}" . PHP_EOL . "{$data->birth_date}" . PHP_EOL;

        $billing = Billing::findOrFail(1);

        echo "{$billing->state->state()}\n";

        $billing->state->transitionTo(Active::class);

        echo "{$billing->state->state()}\n";

        $billing->state->transitionTo(Cancelled::class);

        echo "{$billing->state->state()}\n";

        $billing->state->transitionTo(Pending::class);
    }

    public function action(Request $request, CreateBillingAction $createBilling)
    {
        $billing = Billing::findOrFail(1);

        $createBilling->execute($billing);
    }
}
