@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    @if (\Session::has('delete'))
<div class="alert alert-success">
    <p>{!! \Session::get('delete') !!}</p>
</div>
@endif
    <div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Job Applications</h5>
        <table class="table">
          <thead>

            <tr>
              <th scope="col">#</th>
              <th scope="col">cv</th>
              <th scope="col">job_id</th>
              <th scope="col">job_title</th>
              <th scope="col">Email</th>
              <th scope="col">company</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($applications as $job)
            <tr>
              <th scope="row">{{$job->id  }}</th>
              <td><a class="btn btn-success" href="{{ asset("assets/cvs/".$job->cv) }}">CV</a></td>
              <td><a href="{{ route("single-job",$job->job_id) }}" class="btn btn-success">Go to Job</a></td>
              <td>{{$job->job_title}}</td>
              <td>{{$job->email}}</td>
               <td>{{$job->company_name}}</td>
               <td><a href="{{ route("delete.apps",$job->id)}}" class="btn btn-danger  text-center ">delete</a></td>
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