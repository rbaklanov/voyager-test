<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Domain\Billing\States\Active;
use App\Domain\Billing\States\Pending;
use App\Domain\Billing\Models\Billing;

class Billings
{
    public function state()
    {
        $billing = Billing::findOrFail(1);

        $billing->state->transitionTo(Pending::class);

        echo $billing->state->state();

        $billing->state->transitionTo(Active::class);

        echo $billing->state->state();
    }
}
