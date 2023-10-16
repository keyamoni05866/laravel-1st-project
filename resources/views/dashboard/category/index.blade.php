@extends('layouts.dashboard_master')

@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Category</h1>
            </div>
        </div>
    </div>


    <div class="row">


        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4>Insert Categories</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('category.insert')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <label for="exampleInputEmail1" class="form-label">Category Title:</label>
                        <input type="text" class="form-control form-control-rounded" aria-describedby="..."
                            placeholder="Inset Category Title" name="title">
                            <label for="exampleInputEmail1" class="form-label mt-3">Category Slug:</label>
                        <input type="text" class="form-control  form-control-rounded"
                            aria-describedby="..." placeholder="Inset Category Slug" name="slug">
                            <label for="exampleInputEmail1" class="form-label mt-3">Category Image:</label>
                        <input type="file" class="form-control form-control-solid-bordered form-control-rounded"
                            aria-describedby="..." name="image">
                            <button type="submit" class="btn btn-info btn-md ms-2 mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4>Category Lists</h4>
                </div>
                <div class="card-body ">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                         @forelse ($categories as $category )
                         <tr>
                            <th scope="row">{{$loop->index +1}}</th>
                            <td>  <img style="width: 50px; height:50px; border-radius:50%;" src="{{asset('uploads/category') }}/{{ $category->image}}" alt="">
                            </td>
                            <td>{{$category->title}}</td>
                            <td><button class="btn btn-info btn-sm">{{$category->status}}</button></td>

                            <form action="{{route('category.delete',$category->id)}}" method="POST" >
                                  @csrf
                            <td><button type="submit" class="btn btn-dark btn-sm">Delete</button></td>

                        </form>
                            <td><button type="submit" class="btn btn-primary btn-sm">Update</button></td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-danger">Categories Not Found</td>
                        </tr>
                         @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')

@if (session('category_success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: "{{session('category_success')}}",
  })
</script>

@endif

@if (session('delete_success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: "{{session('delete_success')}}",
  })
</script>

@endif


@endsection
