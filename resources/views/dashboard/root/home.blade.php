
@extends('layouts.dashboard_master');

@section('content')

                        <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Author Request
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>

                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($author_requests as $author)

                         @if ($author->as == false)
                                <tr>
                                     <th scope="row">{{ $loop->index + 1}}</th>
                                     <td>{{$author->name}}</td>
                                     <td><a href="{{ route('author.accept', $author->id)}}" class="btn btn-info btn-sm">Accept</a></td>
                                     <td><a href="{{ route('author.reject', $author->id)}}" class="btn btn-info btn-dark">Reject</a></td>

                              </tr>
                         @endif

                     @empty
                     <tr>
                        <td colspan="4" class="text-danger text-center">No Blogs Found </td>
                    </tr>
                     @endforelse


                        </tbody>
                      </table>
                      {{-- {{ $author_requests->links() }} --}}
                </div>
            </div>
        </div>
    </div>



@endsection



