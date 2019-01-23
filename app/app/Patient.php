<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class Patient extends Model
{
    public function provider() {
      return $this->hasOne('App\User','id','provider_id')->first();
    }

    public function getFormattedDateOfBirthAttribute() {
      $date = new Carbon($this->date_of_birth);

      return $date->format('m/d/Y');
    }

    public function getFormattedNameAttribute() {
      $title = $this->title;
      $name = $this->name;
      $middle_initial = $this->middle_initial;
      $surname = $this->surname;
      $suffix = $this->suffix;

      $string = '';

      // construct fullname string
      if ($title) {
        $string = $title . ' ';
      }

      if ($name) {
        $string = $string . $name . ' ';
      }

      if ($middle_initial) {
        $string = $string . $middle_initial . '. ' ;
      }

      if ($suffix) {
        $string = $string . $surname . ' ' . $suffix;
      } else {
        $string = $string . $surname;
      }


      $array = array(
        'fullname' => $string,
      );

      // construct initials
      $string = '';
      if ($name) {
        $string = substr($name,0,1);
      }

      if ($middle_initial) {
        $string = $string . substr($middle_initial,0,1);
      }

      if ($surname) {
        $string = $string . substr($surname,0,1);
      }

      $array['initials'] = $string;

      return $array;

    }
}