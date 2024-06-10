@extends('layouts.admin')

@section('content')
<div class="container-fluid">
@if (\Session::has('create'))
<p class="alert alert-success">{{ \Session::get("create") }}</p>
@endif
@if (\Session::has('update'))
<p class="alert alert-success">{{ \Session::get("update") }}</p>
@endif
@if (\Session::has('delete'))
<p class="alert alert-success">{{ \Session::get("delete") }}</p>
@endif
  <div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Categories</h5>
       <a  href="{{ route("create.categories") }}" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">update</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
                
            
            <tr>
              <th scope="row">{{ $category->id }}</th>
              <td>{{ $category->name }}</td>
              <td><a  href="{{ route("update.category",$category->id) }}" class="btn btn-warning text-white text-center ">Update </a></td>
              <td><a href="{{ route("delete.category", $category->id) }}" class="btn btn-danger  text-center ">Delete </a></td>
            </tr>
            @endforeach
          </tbody>
        </table> 
      </div>
    </div>
  </div>
</div>
</div>
    
@endsection