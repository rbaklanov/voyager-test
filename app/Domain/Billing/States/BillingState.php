<?php

namespace App\Domain\Billing\States;

use Spatie\ModelStates\State;

abstract class BillingState extends State
{
    abstract public function state(): string;
}

class Pending extends BillingState
{
    public function state(): string
    {
        return 'PENDING';
    }
}

class Active extends BillingState
{
    public function state(): string
    {
        return 'ACTIVE';
    }
}

class Declined extends BillingState
{
    public function state(): string
    {
        return 'DECLINED';
    }
}

class Cancelled extends BillingState
{
    public function state(): string
    {
        return 'CANCELLED';
    }
}

class Failed extends BillingState
{
    public function state(): string
    {
        return 'FAILED';
    }
}
