<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Purchase $purchase)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Purchase $purchase)
    {
        //
    }


    public function delete(User $user, Purchase $purchase)
    {
        //
    }


    public function restore(User $user, Purchase $purchase)
    {
        //
    }


    public function forceDelete(User $user, Purchase $purchase)
    {
        //
    }
}
