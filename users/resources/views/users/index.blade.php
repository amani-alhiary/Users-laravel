@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                <a href="{{ route('users.create') }}">                    
                        <button type="button" class="btn btn-primary float-end">Create User</button>
</a>
                  <div class="x_title">
                    <h2>USERS <small>all users</small></h2>
     
                  </div>
                  </div>



                  <div class="x_content">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                         
                            <th class="column-title">Id </th>
                            <th class="column-title">Image </th>
                            <th class="column-title">Name </th>
                            <th class="column-title">Email </th>
                            <th class="column-title">Type </th>
                            <th class="column-title">Actions </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          @foreach ($users as $user)

                          <tr class="even pointer">
                            
                        
                            <td class=" ">{{ $user->id }}</td>
                            <td class=" "><img src="usersimg/image/{{ $user->photo }}" alt="" style="width: 40px;height:40px;border-radius: 50%;"></td>
                            <td class=" ">{{ $user->name }} {{ $user->lastname }}</td>
                            <td class=" ">{{ $user->email }}</td>
                            <td class=" ">{{ $user->type }}</td>
                            <td class=" last"><a class="btn btn-primary" href="{{ url('showuser?id=' . $user['id']) }}">View</a>

                            <td class=" last"><a class="btn btn-success" href="{{ url('editusers?id=' . $user['id']) }}">Edit</a>
                            </td>
                            <td class=" last">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
</form>


                        <form action="{{ route('users.delete', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Soft Delete</button>
                        </form>
                            </td>

                          </tr>
                    
                                        
  
                        @endforeach

                        </tbody>
                      </table>
                      {{ $users->links('pagination::bootstrap-5') }}

                    </div>
							
						
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        </div>
    </div>
</div>

@endsection
