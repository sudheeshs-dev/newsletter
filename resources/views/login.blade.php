@extends('layouts.admin')
@section('content')
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh">
        <div class="row">
            <div class="col content-center card">
                @if($errors->any())
                <div class="alert alert-danger d-flex align-items-center mt-1" role="alert">
                    <div>
                        Please Try Again
                    </div>
                </div>
                @endif
                <form class="m-5" action="{{url('login_action')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <h2>Login</h2>
                    </div>
                    <div class="mb-3">
                        <label for="adminemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="adminemail" name="email" required> 
                    </div>
                    <div class="mb-3">
                        <label for="adminpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="adminpassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="/password/reset" class="btn btn-link">Forget Password?</a>
                </form>

            </div>
        </div>
    </div>
@endsection
