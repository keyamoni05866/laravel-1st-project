@extends('layouts.dashboard_master');

@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>Blogs Insert Page</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mx-auto" style="width:800px">
            <div class="card-body">
                <form  action="{{ route('blog.insert') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label ">Blog Title:</label>
                            <input type="text" class="form-control form-control-rounded" aria-describedby="..."
                                placeholder="Inset Category Title" name="title">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Blog Category:</label>
                            <select name="category_id" class="form-control form-control-rounded">
                                <option>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label mt-3">Blog Image:</label>
                            <input type="file" class="form-control form-control-solid-bordered form-control-rounded"
                                aria-describedby="..." name="image">
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label mt-3">Blog Submit Date:</label>

                            <input class="form-control form-control-solid-bordered form-control-rounded" type="date" class="form-control  form-control-rounded" aria-describedby="..."
                                placeholder="Inset Category Slug" name="date">
                        </div>

                    </div>


                   <div>
                    <label  class="form-label mt-3">Select Tag:</label>
                    <br>
                    @foreach ($tags as $tag)



                         <input class="mb-2 ms-3"    type="checkbox" id="{{$tag->id}}" name="ids[]" value="{{$tag->id}}" ><label class="text-dark fs-5 ms-1 " for="{{$tag->id}}">{{$tag->title}}</label>

                    @endforeach
                   </div>

                    <label for="exampleInputEmail1" class="form-label mt-3">Blog Description:</label>
                    <textarea id="summernote" class="form-control  form-control-rounded" name="description" ></textarea>
                    <button type="submit" class="btn btn-info btn-md ms-2 mt-4 btn-md">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
