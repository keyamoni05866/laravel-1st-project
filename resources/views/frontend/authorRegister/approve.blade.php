@extends('layouts.master')

@section('content')
    <!--page404-->
    <div class="page404 ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="page404-content">
                       <img src="{{ asset('frontend')}}/assets/img/other/pending.jpg" alt="">
                        <h3>Oops... Your Approve is Pending!</h3>
                        <p>You have to wait for our admin approval then you can write blogs.Till then,Stay With Us. <br> Please return to the homepage.
                        </p>
                        <a href="{{ route('root')}}" class="btn-custom">Back to homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
