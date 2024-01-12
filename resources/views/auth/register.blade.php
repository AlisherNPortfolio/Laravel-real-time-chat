@extends('layouts.auth')

@section('content')
<div class="col-xl-10">
    <div class="card border-0">
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="mb-5">
                            <h3 class="h4 font-weight-bold text-theme">Register</h3>
                        </div>

                        <h6 class="h5 mb-0">Hello!</h6>
                        <p class="text-muted mt-2 mb-5">Enter your name, email address and password to register.</p>

                        <form action="{{ route('make_register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group mb-5">
                                <label for="pass">Password</label>
                                <input type="password" class="form-control" id="pass" name="password">
                            </div>
                            <button type="submit" class="btn btn-theme">Register</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-inline-block">
                    <div class="account-block rounded-right">
                        <div class="overlay rounded-right"></div>
                        <div class="account-testimonial">
                            <h4 class="text-white mb-4">This  beautiful theme yours!</h4>
                            <p class="lead text-white">"Best investment i made for a long time. Can only recommend it for other users."</p>
                            <p>- Admin User</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->

    <p class="text-muted text-center mt-3 mb-0">Already have account? <a href="{{ route('login') }}" class="text-primary ml-1">login</a></p>

    <!-- end row -->

</div>
@endsection
