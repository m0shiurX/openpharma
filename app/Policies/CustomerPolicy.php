<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Customer $customer)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Customer $customer)
    {
        //
    }


    public function delete(User $user, Customer $customer)
    {
        //
    }


    public function restore(User $user, Customer $customer)
    {
        //
    }


    public function forceDelete(User $user, Customer $customer)
    {
        //
    }
}
