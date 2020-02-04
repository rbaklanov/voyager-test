<?php

namespace App\Domain\Billing\Models;

use Spatie\ModelStates\HasStates;
use App\Domain\Billing\States\Active;
use App\Domain\Billing\States\Cancelled;
use App\Domain\Billing\States\Declined;
use App\Domain\Billing\States\Failed;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Billing\States\BillingState;
use App\Domain\Billing\States\Pending;

/**
 * @property \App\Domain\Billing\States\BillingState $state
 */
class Billing extends Model
{
    use HasStates;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'billings';

    protected function registerStates(): void
    {
        $this
            ->addState('state', BillingState::class)
            ->default(Pending::class)
            ->allowTransition(Pending::class, Active::class)
            ->allowTransition(Pending::class, Failed::class)
            ->allowTransition(Pending::class, Declined::class)
            ->allowTransition(Active::class, Cancelled::class)
            ->allowTransition(Cancelled::class,Pending::class);
    }
}
