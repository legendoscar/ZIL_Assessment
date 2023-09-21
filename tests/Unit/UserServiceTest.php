<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

class UserServiceTest extends TestCase
{

	use WithFaker
	, RefreshDatabase
	// , DatabaseMigrations
	;

    /**
     * @test
     * @return void
     */
    public function it_can_return_a_paginated_list_of_users()
    {

    	// Arrangements
    	$user = User::factory()->create();

		// Actions
    	$response = $this->actingAs($user)
	     // ->withSession(['banned' => false])
	     ->get('/users');

		// Assertions
        $response->assertStatus(200);

    }

    /**
     * @test
     * @return void
     */
    public function it_can_store_a_user_to_database()
    {
		// Arrangements

		// Actions
    	$user = User::factory()->create();

		// Assertions
    	$this->assertModelExists($user);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_find_and_return_an_existing_user()
    {
	
		// Arrangements
    	$user = User::factory()->create();

		// Actions
    	$response = $this->actingAs($user)
         // ->withSession(['banned' => false])
         ->get('/users/show');

		// Assertions
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_update_an_existing_user()
    {
	
		// Arrangements
    	$user = User::factory()->create();

    	// $user = User::find(1);

    	$email = 'devlegendoar@gmail.com';

		// Actions
    	$this->actingAs($user)
         ->patch(route('users.update', $user), [
         	'firstname' => $user->firstname,
         	'lastname' =>  $user->lastname,
         	'username' =>  $user->username,
         	'password' =>  $user->password,
         	'password_confirmation' => $user->password,
         	'email' => $user->email
         	])->assertStatus(302);

		// Assertions

         // $response->assertStatus(200);
  //       $this->assertDatabaseHas('users', [
		//     'email' => $email,
		// ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_soft_delete_an_existing_user()
    {
		// Arrangements
    	$user = User::factory()->create();

		// Actions
    	$this
    	->actingAs($user)
         ->delete(route('users.destroy', $user));

		// Assertions
    	$this->assertSoftDeleted($user);

    }

    /**
     * @test
     * @return void
     */
    public function it_can_return_a_paginated_list_of_trashed_users()
    {
		// Arrangements
    	$user = User::factory()->create();

		// // Actions
    	$response = $this->actingAs($user)
         ->get('/users/trashed');

		// Assertions
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_restore_a_soft_deleted_user()
    {
		// Arrangements
    	$user = User::factory()->create();

		// Actions
    	$this
    	->actingAs($user)
         ->patch(route('users.restore', $user));

		// Assertions
    	$this->assertNotSoftDeleted($user);

    }

    /**
     * @test
     * @return void
     */
    public function it_can_permanently_delete_a_soft_deleted_user()
    {
		// Arrangements
    	$user = User::factory()->create();

		// Actions
    	$this
    	->actingAs($user)
         ->delete(route('users.forcedelete', $user));

		// Assertions
    	$this->assertModelMissing($user);

    }

    /**
     * @test
     * @return void
     */
    public function it_can_upload_photo()
    {

		// Arrangements
		$file=UploadedFile::fake()->image('file.png', 600, 600);


		// Actions
		$this->post(route("users.create"),["photo" =>$file]);
		$user= User::factory()->create();


		// Assertions
		//check file exists in the directory
		Storage::disk("local")->assertExists($user->file); 


    }
}
