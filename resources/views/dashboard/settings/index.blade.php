@extends('layouts.dashboard_master')


@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Settings</h1>
        </div>
    </div>
</div>


<div class="row">

@if (auth()->user()->role == 'administrator')
        <div class="col-5">
    <div class="card">
            <div class="card-header">
                <h4 class="text-center text-info">Admin Registration</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.insert')}}" method="POST">
                    @csrf
                    <label for="exampleInputEmail1" class="form-label">Your Name:</label>
                    <input type="text"  class="form-control form-control  @error('name') is-invalid @enderror"
                        id="exampleInputEmail1" aria-describedby="emailHelp" name="name" >

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <label for="exampleInputEmail1" class="form-label mt-2">Your Email:</label>
                        <input type="text" class="form-control  @error('email') is-invalid @enderror"
                            id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="exampleInputEmail1" class="form-label mt-3"> Password:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="exampleInputEmail1" aria-describedby="emailHelp" name="password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="exampleInputEmail1" class="form-label mt-3">Confirm Password:</label>
                    <input type="password" class="form-control "
                        id="exampleInputEmail1" aria-describedby="emailHelp" name="password_confirmation">


                    <button type="submit" class="btn btn-info btn-lg mt-4">Submit</button>
                </form>
            </div>
        </div>
        </div>

@else
<div class="col-5">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center text-info">Customer Lists</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                 @if (auth()->user()->role == 'admin')
                       <th scope="col">Action</th>
                 @endif
                  </tr>
                </thead>
                <tbody>
               @forelse ($customers as $customer)
                   <tr>
                     <th scope="row">{{ $loop->index +1}}</th>
                     <td>{{$customer->name}}</td>
                     <td>{{$customer->email}}</td>
                     <td>{{$customer->role}}</td>
                     @if (auth()->user()->role == 'admin')
                     <td>
                      <a href="" class="btn btn-dark btn-sm">
                           Delete
                    </a>
                    </td>
                    @endif




                   </tr>
               @empty
                 <tr>
                    <td colspan="5" class="text-danger text-center">No Data Found</td>
                 </tr>
               @endforelse

                </tbody>
              </table>
        </div>
    </div>
</div>

@endif



    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center text-info">Admin Lists</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                     @if (auth()->user()->role == 'administrator')
                           <th scope="col">Action</th>
                     @endif
                      </tr>
                    </thead>
                    <tbody>
                   @forelse ($admins as $admin)
                       <tr>
                         <th scope="row">{{ $loop->index +1}}</th>
                         <td>{{$admin->name}}</td>
                         <td>{{$admin->email}}</td>
                         <td>{{$admin->role}}</td>
                         @if (auth()->user()->role == 'administrator')
                         <td>
                          <a href="" class="btn btn-dark btn-sm">
                               Delete
                        </a>
                        </td>
                        @endif




                       </tr>
                   @empty
                   <tr>
                    <td colspan="5" class="text-danger text-center">No Data Found</td>
                 </tr>
                   @endforelse

                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>


{{-- for making customer or any role --}}

<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-header">
                <h4>Assign Role</h4>

                <div class="card-body">
                   <form action="{{route('role.update')}}" method="POST">
                    @csrf
                    <label for="exampleInputEmail1" class="form-label mt-3">Users</label>
                    <select class="form-control" name="user_name">
                        @foreach ($alls as $all)
                            <option value="{{$all->id}}">{{$all->name}}</option>
                        @endforeach
                    </select>
                    <label for="exampleInputEmail1" class="form-label mt-3">Role</label>
                    <select class="form-control" name="role_name">
                        <option value="editor">Editor</option>
                        <option value="customer">Customer</option>
                        <option value="moderator">Moderator</option>
                        <option value="author">Author</option>
                        <option value="visitor">Visitor</option>
                    </select>
                    <button type="submit" class="btn btn-info btn-md mt-4">Update</button>

                   </form>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

@section('footer_script')
@if (session('success'))
<script>
  Swal.fire({
  position: 'top-center',
  icon: 'success',
  title: "{{ session('success') }}",
  showConfirmButton: false,
  timer: 3000
})
</script>

@endif
@endsection
