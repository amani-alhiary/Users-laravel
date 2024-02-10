<?php
// app/Services/UserService.php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    protected $model;
    protected $request;

    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
      // ... (other methods)

      public function list()
      {
          $perPage = $this->request->get('per_page', 10); // Default to 10 users per page
          $page = $this->request->get('page', 1);
  
          // Use Eloquent's paginate method to get a paginated list of users
          $users = $this->model->paginate($perPage, ['*'], 'page', $page);
  
          return $users;
      }
      public function hash(string $key): string
      {
          // Implementation for generating a random hash key
          return bcrypt($key); // Adjust this implementation based on your requirements
      }


  
      // ... (other methods)
  
      public function store(array $attributes)
      {
          return $this->model->create($attributes);
      }
  
  

      
    public function find(int $id): ?User
    {
        return $this->model->find($id);
    }



    public function update(int $id, array $attributes): bool
    {
        $user = $this->model->find($id);

        if ($user) {
            return $user->update($attributes);
        }

        return false;
    }



    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }



    
    public function listTrashed(): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->paginate();
    }



    public function restore(int $id): void
    {
        $this->model->withTrashed()->where('id', $id)->restore();
    }



    public function delete(int $id): void
    {
        $this->model->withTrashed()->where('id', $id)->forceDelete();
    }





    public function upload(UploadedFile $file): ?string
    {
        // Customize the file upload logic based on your requirements
        // For example, you can store the file in the storage folder and return the file path

        if ($file->isValid()) {
            $path = $file->store('profile_photos', 'public');
            return $path;
        }

        return null;
    }

    public function rules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'prefixname' => 'string|max:255',
            'middlename' => 'string|max:255',
            'suffixname' => 'string|max:255',
            'type' => 'string|max:255',
        ];
    }



    public function saveUserDetails(User $user)
    {
        $fullName = $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname;
        $middleInitial = $user->middlename ? strtoupper(substr($user->middlename, 0, 1)) . '.' : '';
        $avatar = $user->photo ? $user->photo : 'default_avatar.jpg'; // Assuming a default avatar if no photo provided
        $gender = $user->prefixname === 'Mr.' ? 'male' : ($user->prefixname === 'Mrs.' ? 'female' : '');

           // Save details to the table
           $user->details()->create([
            'key' => 'full_name',
            'value' => $fullName,
            'icon' => 'user',
        ]);

        $user->details()->create([
            'key' => 'middle_initial',
            'value' => $middleInitial,
            'icon' => 'user',
        ]);

        $user->details()->create([
            'key' => 'avatar',
            'value' => $avatar,
            'icon' => 'image',
        ]);

        $user->details()->create([
            'key' => 'gender',
            'value' => $gender,
            'icon' => 'gender',
        ]);
    }

    
}
