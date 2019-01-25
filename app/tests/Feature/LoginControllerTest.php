<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Hash;


class LoginControllerTest extends TestCase
{

  use RefreshDatabase;

  /** @test */
  public function controller_shows_login_view() {

    $response = $this->get('/');

    //$response->assertStatus(200);
    $response->assertViewIs('login');
  }


  /** @test */
  public function controller_redirects_logged_in_user() {

    $user = factory('App\User')->make();

    $response = $this->actingAs($user)->get('/');

    $response->assertRedirect('/provider');


  }

  /** @test */
  public function controller_logs_in_a_user() {
    $user = factory('App\User')->create([
      'username' => 'johnny',
      'password' => Hash::make('this is a password'),
    ]);

    $response = $this->post('/', [
      'email' => $user->email,
      'password' => 'this is a password',
    ]);

    $response->assertRedirect('/provider');
    $this->assertAuthenticatedAs($user);
  }

}