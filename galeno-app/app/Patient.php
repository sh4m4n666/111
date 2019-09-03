<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Patient extends Model
{
    protected $fillable = [
      'name', 'gender', 'date_of_birth', 'occupation', 'phone',
      'email', 'address', 'city', 'guardian_name', 'guardian_phone',
      'nhif_number', 'nhif_owner', 'profile_image_url'
    ];

    protected $appends = ['age'];

    public function users() {
      return $this->belongsToMany('App\User');
    }

    public function assign(User $user)
    {
      $this->users()->attach($user->id);
    }


    public function getAgeAttribute() {
      return $this->dob->age;
    }

}