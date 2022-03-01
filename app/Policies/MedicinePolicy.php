<?php

namespace App\Policies;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicinePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }


    public function view(User $user, Medicine $medicine)
    {
        //
    }


    public function create(User $user)
    {
        //
    }


    public function update(User $user, Medicine $medicine)
    {
        //
    }


    public function delete(User $user, Medicine $medicine)
    {
        //
    }


    public function restore(User $user, Medicine $medicine)
    {
        //
    }


    public function forceDelete(User $user, Medicine $medicine)
    {
        //
    }
}
