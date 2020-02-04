<?php

namespace App\Controllers;

use App\Domain\Billing\States\Cancelled;
use Illuminate\Http\Request;
use App\Domain\Billing\States\Active;
use App\Domain\Billing\States\Pending;
use App\Domain\Billing\Models\Billing;

class Billings
{
    public function state(Request $request)
    {
        $billing = Billing::findOrFail(1);

        echo "{$billing->state->state()}\n";

        $billing->state->transitionTo(Active::class);

        echo "{$billing->state->state()}\n";

        $billing->state->transitionTo(Cancelled::class);

        echo "{$billing->state->state()}\n";

        $billing->state->transitionTo(Pending::class);
    }
}
