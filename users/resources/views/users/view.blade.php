@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="styles/details.css">

<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
     <div class="card p-4"> <div class=" image d-flex flex-column justify-content-center align-items-center"> 
        <button class="btn btn-secondary"> 
            <img src="usersimg/image/{{ $user->photo }}" height="100" width="100" style="border-radius:50%" /></button>
         <span class="name mt-3">{{ $user->prefixname }} {{ $user->name }} {{ $user->lastname }}</span> 
         <span class="idd">{{ $user->suffixname }}</span> 
         <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
            <span class="idd1">{{ $user->name }} {{ $user->middlename }} {{ $user->lastname }}</span> <span><i class="fa fa-copy"></i></span> </div>
             <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
             <span class="follow" style="padding-right:5px">Joined  </span><span class="number"> {{ $user->created_at->format('Y-m-d') }} </span>
             </div> 
                <!-- <div class=" d-flex mt-2"> <a href="{{ url('editusers?id=' . $user['id']) }}"><button class="btn1 btn-dark">Edit User</button></a> </div>  -->
                 
        </div> 
    </div>
</div>




@endsection