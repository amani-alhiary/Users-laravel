@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('users.update',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="prefixname" class="col-md-4 col-form-label text-md-end">{{ __('prefixname') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" id="prefixname" name="prefixname" autofocus>
                                <option value="Mr" {{ $user->prefixname == 'Mr' ? ' selected' : '' }}>Mr.</option>
                                  <option value="Ms" {{ $user->prefixname == 'Ms' ? ' selected' : '' }}>Ms.</option>
                                  <option value="Miss" {{ $user->prefixname == 'Miss' ? ' selected' : '' }}>Miss</option>
                                  </select>
                                @error('prefixname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="middlename" class="col-md-4 col-form-label text-md-end">{{ __('Middle name') }}</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" value="{{ $user->middlename }}" class="form-control @error('middlename') is-invalid @enderror" name="middlename"   autocomplete="middlename" autofocus>

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" value="{{ $user->lastname }}" class="form-control @error('lastname') is-invalid @enderror" name="lastname"  required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="suffixname" class="col-md-4 col-form-label text-md-end">{{ __('Suffix name') }}</label>

                            <div class="col-md-6">
                                <input id="suffixname" type="text" value="{{ $user->suffixname }}" class="form-control @error('suffixname') is-invalid @enderror" name="suffixname"   autocomplete="suffixname" autofocus>

                                @error('suffixname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" value="{{ $user->email }}" class="form-control" name="email"  required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="{{ $user->password }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <!-- <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" value="{{ $user->password }}" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('type') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" id="type" name="type" autofocus>
                                <option value="user" {{ $user->prefixname == 'user' ? ' selected' : '' }}>user</option>
                                  <option value="admin" {{ $user->prefixname == 'admin' ? ' selected' : '' }}>admin</option>
                                  </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                       <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                       <div class="col-md-6">
                      <div class="input-group">
                      <img src="usersimg/image/{{ $user->photo }}" style="border-radius:50%;height:100px;width:100px">
                      <input type="file" name="photo"  id="fileupload" class="form-control">
                      <!-- <label class="input-group-text" for="photo">Choose file</label> -->
        </div>

        @error('photo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    </div>
            </div>
        </div>
    </div>
</div>







@endsection