<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Services\UserService;
// use App\Events\UserSaved;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        
    }

    public function index()
    {
         $users = User::orderBy('id','desc')->paginate(5);

        return view('users.index', compact('users'));
    }



    public function create()
    {
        return view('users.create');
    }





    protected function store(Request $data)
    {
        
        
        
 $validator = Validator::make($data->all(), [
    'name' => 'required|string|max:255',
    'lastname' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8',
    'prefixname' => 'string|max:255',
    'middlename' => 'string|max:255',
    'suffixname' => 'string|max:255',
    'type' => 'string|max:255',
    // 'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
]);

if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput($data->all());
}


if ($image = $data->file('photo')) {

    $destinationPath = public_path('usersimg/image/');
    $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    $image->move($destinationPath, $profileImage);
    $data['photo'] = $profileImage;
}else {
    $profileImage = 'user.jpg';
}



// Create the user
 User::create([
    'name' => $data->input('name'),
    'lastname' => $data->input('lastname'),
    'email' => $data->input('email'),
    'password' => Hash::make($data->input('password')),
    'prefixname' => $data->input('prefixname'),
    'middlename' => $data->input('middlename'),
    'suffixname' => $data->input('suffixname'),
    'type' => $data->input('type'),
    'photo' => $profileImage,
]);
return redirect()->route('users.index')
->with('success', 'User created successfully.');

}




public function show(Request $request)
{
    $user = User::find($request->id);

    return view('users.view', compact('user'));

    }


    public function edit(Request $request)
    {
        $user = User::find($request->id);

        return view('users.edit',compact('user'));

    }




    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'prefixname' => 'string|max:255',
        //     'middlename' => 'string|max:255',
        //     'suffixname' => 'string|max:255',
        //     'type' => 'string|max:255',

          
        // ]);


    $input = request()->except(['_token', '_method','submit' ]);
   


    if($request->file('photo')){
        $file= $request->file('photo');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('usersimg/image'), $filename);
        $input['photo']= $filename;
    }else{
        unset($input['photo']);
    }

 
    User::whereId($id)->update($input);
  
    return redirect()->route('users.index')
        ->with('success', 'User updated successfully.');
}






public function destroy($id)
{
    User::whereId($id)->forceDelete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully');
}


public function trashedusers()
{
    $trashedUsers = User::onlyTrashed()->get();
   
    return view('users.trashed', compact('trashedUsers'));
}

public function restore($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();
     
    return redirect()->route('trashedusers.index')
        ->with('success', 'User restored successfully.');
  
}


public function delete($id)
{
    
    $user = User::withTrashed()->findOrFail($id);
    
    $user->delete();

  
    return redirect()->route('trashedusers.index')
        ->with('success', 'User deleted successfully.');
  
}


}
