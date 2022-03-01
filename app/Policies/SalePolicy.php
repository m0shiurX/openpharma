<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Sale $sale)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Sale $sale)
    {
        //
    }


    public function delete(User $user, Sale $sale)
    {
        //
    }


    public function restore(User $user, Sale $sale)
    {
        //
    }


    public function forceDelete(User $user, Sale $sale)
    {
        //
    }
}
