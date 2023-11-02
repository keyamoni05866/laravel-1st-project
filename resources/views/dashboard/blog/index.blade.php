@extends('layouts.dashboard_master');


@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Blogs</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="d-flex justify-content-end mb-4">
            <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">
                Recycle Bin
            </button>
        </div>
    </div>

    {{-- modal for trash --}}

    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your Deleted Blogs</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($trashes as $trash)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>
                                        <img src="{{ asset('uploads/blog') }}/{{ $trash->image }}" alt=""
                                            style="width:80px; height:50px; border-radius:50%">
                                    </td>
                                    <td>{{ $trash->title }}</td>

                                    <td>{{ $trash->RelationWithUser->name }}</td>
                                    <td>{{ $trash->RelationWithCategory->title }}</td>
                                    <td>

                                        <form action="{{ route('blog.restore', $trash->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-info btn-sm">Restore</button>
                                        </form>

                                    </td>
                                    <td>
                                        <form action="{{ route('blog.restore.delete', $trash->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-dark btn-sm">Permanent Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="9" class="text-danger text-center">No Blogs Found </td>
                                </tr>
                            @endforelse


                        </tbody>

                    </table>


                </div>

            </div>
        </div>
    </div>

    {{-- main content starts from here --}}




    @if (auth()->user()->role == 'administrator' || auth()->user()->role == 'admin')
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Blogs</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Details</th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alls as $blog)
                                <tr>
                                    <th scope="row">{{ $alls->firstItem() + $loop->index }}</th>
                                    <td>
                                        <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt=""
                                            style="width:80px; height:50px; border-radius:50%">
                                    </td>
                                    <td>{{ $blog->title }}</td>

                                    <td>{{ $blog->RelationWithUser->name }}</td>
                                    <td>{{ $blog->RelationWithCategory->title }}</td>
                                    <td>
                                       @if ($blog->status == 'active')
                                        <a href="{{ route('blog.status', $blog->id) }}" class="btn  btn-success btn-sm">{{ $blog->status }}</a
                                       @else
                                        <a href="{{ route('blog.status', $blog->id) }}" class="btn  btn-outline-secondary btn-sm">{{ $blog->status }}</a


                                       @endif


                                        </td>

                                    {{-- for info --}}
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#blogModal{{ $blog->id }}">Info</button>

                                        <!-- Modal for full Information -->
                                        <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}"
                                                            alt=""
                                                            style="width:300px; height:170px; border-radius:5%;margin-left:70px">

                                                        <div class="mt-4 ms-3 ">
                                                            <h4 class=" text-center mb-3"><span class="fw-bold"> </span>
                                                                <span class="text-info">{{ $blog->title }}</span>
                                                            </h4>

                                                            <h6 class="fs-5"><span class=" me-2">Your Name:</span>
                                                                {{ $blog->RelationWithUser->name }} </h6>
                                                            <h6 class="fs-5"><span class="me-2">Category-Name:</span>
                                                                {{ $blog->RelationWithCategory->title }}</h6>


                                                            <h6 class="fs-5"> <span class=" me-2">Submit Date:</span>

                                                                {{ $blog->date }}
                                                            </h6>


                                                            <p><span class="fw-bold fs-5">Description:</span>
                                                                {{ $blog->description }}</p>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>



                                    <td><a href="{{ route('blog.edit.view', $blog->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a></td>
                                    <td>
                                        <form action="{{ route('blog.delete', $blog->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-dark btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    <td>

                                      @if (auth()->user()->role == 'administrator' || auth()->user()->role ==   'admin')
                                          @if ( $blog->feature == 'active')
                                              <a href="{{ route('blog.feature', $blog->id) }}"
                                                  class="btn btn-success btn-sm">Featured</a>


                                           @else
                                              <a href="{{ route('blog.feature', $blog->id) }}"
                                                  class="btn btn-primary btn-sm">Feature</a>


                                          @endif
                                      @endif
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="9" class="text-danger text-center">No Blogs Found </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                    {{ $alls->links() }}
                </div>
            </div>
        </div>
    </div>

        @else
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Blogs</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Action</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <th scope="row">{{ $blogs->firstItem() + $loop->index }}</th>
                                        <td>
                                            <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt=""
                                                style="width:80px; height:50px; border-radius:50%">
                                        </td>
                                        <td>{{ $blog->title }}</td>

                                        <td>{{ $blog->RelationWithUser->name }}</td>
                                        <td>{{ $blog->RelationWithCategory->title }}</td>
                                        <td>
                                           @if ($blog->status == 'active')
                                            <a href="{{ route('blog.status', $blog->id) }}" class="btn  btn-success btn-sm">{{ $blog->status }}</a
                                           @else
                                            <a href="{{ route('blog.status', $blog->id) }}" class="btn  btn-outline-secondary btn-sm">{{ $blog->status }}</a


                                           @endif


                                            </td>

                                        {{-- for info --}}
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#blogModal{{ $blog->id }}">Info</button>

                                            <!-- Modal for full Information -->
                                            <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog  modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <img src="{{ asset('uploads/blog') }}/{{ $blog->image }}"
                                                                alt=""
                                                                style="width:300px; height:170px; border-radius:5%;margin-left:70px">

                                                            <div class="mt-4 ms-3 ">
                                                                <h4 class=" text-center mb-3"><span class="fw-bold"> </span>
                                                                    <span class="text-info">{{ $blog->title }}</span>
                                                                </h4>

                                                                <h6 class="fs-5"><span class=" me-2">Your Name:</span>
                                                                    {{ $blog->RelationWithUser->name }} </h6>
                                                                <h6 class="fs-5"><span class="me-2">Category-Name:</span>
                                                                    {{ $blog->RelationWithCategory->title }}</h6>


                                                                <h6 class="fs-5"> <span class=" me-2">Submit Date:</span>

                                                                    {{ $blog->date }}
                                                                </h6>


                                                                <p><span class="fw-bold fs-5">Description:</span>
                                                                    {{ $blog->description }}</p>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>



                                        <td><a href="{{ route('blog.edit.view', $blog->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a></td>
                                        <td>
                                            <form action="{{ route('blog.delete', $blog->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-dark btn-sm">Delete</button>
                                            </form>
                                        </td>
                                        <td>

                                          @if (auth()->user()->role == 'administrator' || auth()->user()->role ==   'admin')
                                              @if ( $blog->feature == 'active')
                                                  <a href="{{ route('blog.feature', $blog->id) }}"
                                                      class="btn btn-success btn-sm">Featured</a>


                                               @else
                                                  <a href="{{ route('blog.feature', $blog->id) }}"
                                                      class="btn btn-primary btn-sm">Feature</a>


                                              @endif
                                          @endif
                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="9" class="text-danger text-center">No Blogs Found </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('footer_script')
    {{-- delete --}}
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
                title: "{{ session('delete_success') }}",
            })
        </script>
    @endif
@endsection
