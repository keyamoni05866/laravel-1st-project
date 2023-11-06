@extends('layouts.master')

@section('content')
 <!--Login-->
 <section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Login</h4>
                    <p></p>
                    <form  action="{{ route('author.login')}}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                <input type="email" class="form-control" placeholder="Username*" name="email" value="{{session('s_email')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="{{session('s_password')}}">
                        </div>
                        <div class="sign-controls form-group">
                            {{-- <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div> --}}
                            <a href="#" class="btn-link ">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Login in</button>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="signup.html" class="btn-link">Create One</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>





@endsection

@section('footer_script')

@if (session('register_message'))
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
                title: "{{ session('register_message') }}",
            })
        </script>
    @endif
@endsection
