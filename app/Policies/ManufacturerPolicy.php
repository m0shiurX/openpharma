<?php

namespace App\Policies;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManufacturerPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Manufacturer $manufacturer)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Manufacturer $manufacturer)
    {
        //
    }


    public function delete(User $user, Manufacturer $manufacturer)
    {
        //
    }


    public function restore(User $user, Manufacturer $manufacturer)
    {
        //
    }


    public function forceDelete(User $user, Manufacturer $manufacturer)
    {
        //
    }
}
