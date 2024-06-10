@extends('layouts.admin')
@section('content')
@if(\Session::has('error'))
<p class="alert alert-warning">{{ \Session::get('error') }}</p>
@endsession
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mt-5">Login</h5>
                <form method="POST" class="p-auto">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" />
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password"  placeholder="Password" class="form-control" />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection