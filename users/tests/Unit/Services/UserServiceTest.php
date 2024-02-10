<?php
namespace Tests\Unit\Services;

use App\Models\User; // Correct namespace for the User model
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Pagination\LengthAwarePaginator; // Import LengthAwarePaginator
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class UserServiceTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /**
     * @var UserService
     */
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = new UserService(new User(), app('request')); // Use correct namespace for User model
    }




    /**
 * @test
 */
public function it_can_return_a_paginated_list_of_users()
{
     // Arrangements
     User::factory()->count(10)->create(); // Use the User model's factory method

     // Actions
     $result = $this->userService->list();

     // Assertions
     $this->assertInstanceOf(LengthAwarePaginator::class, $result);
     $this->assertEquals(10, $result->total());
     // Add more assertions as needed
}



 /**
     * @test
     */
    public function it_can_store_a_user_to_database()
    {
        // Arrangements
        $userAttributes = [
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastname,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            
            // Add other attributes as needed
        ];

        // Actions
        $createdUser = $this->userService->store($userAttributes);

        // Assertions
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertDatabaseHas('users', ['email' => $userAttributes['email']]);
        // Add more assertions as needed
    }

    


       /**
     * @test
     */
    public function it_can_find_and_return_an_existing_user()
    {
        // Arrangements
        $user = User::factory()->create(); // Create a user for testing

        // Actions
        $foundUser = $this->userService->find($user->id);

        // Assertions
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
        // Add more assertions as needed
    }





     /**
     * @test
     */
    public function it_can_update_an_existing_user()
    {
        // Arrangements
        $user = User::factory()->create(); // Create a user for testing
        $newAttributes = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            // Add other attributes you want to update
        ];

        // Actions
        $result = $this->userService->update($user->id, $newAttributes);

        // Assertions
        $this->assertTrue($result);
          // Refresh the user instance from the database to get the latest attributes
          $updatedUser = $user->fresh();

          $this->assertEquals($newAttributes['name'], $updatedUser->name);
          $this->assertEquals($newAttributes['email'], $updatedUser->email);
          // Add more assertions as needed
      }




    //     /**
    //  * @test
    //  */
    public function it_can_soft_delete_an_existing_user()
    {
        // Arrangements
        $user = User::factory()->create(); // Create a user for testing

        // Actions
        $result = $this->userService->destroy($user->id);

        // Assertions
        $this->assertTrue($result);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
        // Add more assertions as needed
    }


  


   public function it_can_return_a_paginated_list_of_trashed_users()
   {
       // Arrangements
       User::factory()->count(10)->create(); // Create 10 users
       User::factory()->count(5)->create(['deleted_at' => now()]); // Create 5 trashed users

       // Actions
       $result = $this->userService->listTrashed();

       // Assertions
       $this->assertInstanceOf(LengthAwarePaginator::class, $result);
       $this->assertEquals(5, $result->total());
       // Add more assertions as needed
   }





//   /**
//      * @test
//      */
    public function it_can_restore_a_soft_deleted_user()
    {
        // Arrangements
        $user = User::factory()->create();
        $user->delete(); // Soft delete the user

        // Actions
        $this->userService->restore($user->id);

        // Assertions
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
        // Add more assertions as needed
    }



   public function it_can_permanently_delete_a_soft_deleted_user()
   {
       // Arrangements
       $user = User::factory()->create();
       $user->delete(); // Soft delete the user

       // Actions
       $this->userService->delete($user->id);

       // Assertions
       $this->assertDatabaseMissing('users', ['id' => $user->id]);
       // Add more assertions as needed
   }





  /**
     * @test
     */
    public function it_can_upload_photo()
    {
        // Arrangements
        Storage::fake('public'); // Fake the public storage disk

        $file = UploadedFile::fake()->image('photo.jpg'); // Create a fake uploaded file

        // Actions
        $result = $this->userService->upload($file);

        // Assertions
        $this->assertNotNull($result);
        $this->assertStringContainsString('profile_photos', $result); // Adjust the folder name based on your storage configuration
        Storage::disk('public')->assertExists($result);
        // Add more assertions as needed
    }


}