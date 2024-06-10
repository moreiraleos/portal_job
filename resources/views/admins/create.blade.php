@extends('layouts.admin')
@section('content')

<div class="container-fluid">
   
    <div class="row">
     <div class="col">
       <div class="card">
         <div class="card-body">
           <h5 class="card-title mb-5 d-inline">Create Admins</h5>
       <form method="POST" enctype="multipart/form-data">
        @csrf
             <!-- Email input -->
             <div class="form-outline mb-4 mt-4">
                @if ($errors->has('email'))
                    <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                @endif
               <input type="email"  name="email" id="form2Example1" class="form-control" placeholder="email" />
             </div>
             <div class="form-outline mb-4">
                @if ($errors->has('username'))
                    <p class="alert alert-danger">{{ $errors->first('username') }}</p>
                @endif
               <input type="text" name="username" id="form2Example1" class="form-control" placeholder="name" />
             </div>
             <div class="form-outline mb-4">
                @if ($errors->has('password'))
                    <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                @endif
               <input type="password" required name="password" id="form2Example1" class="form-control" placeholder="password" />
             </div>
             <!-- Submit button -->
             <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>
           </form>
         </div>
       </div>
     </div>
   </div>
</div>

@endsection