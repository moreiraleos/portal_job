@extends('layouts.app');
@section('content')
<!-- HOME -->


<section class="section-hero overlay inner-page bg-image" style="background-image: url('{{ asset("assets/images/hero_1.jpg")}}'); margin-top: -50px;" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Update Details</h1>
                <div class="custom-breadcrumbs">
                    <a href="#">Home</a> <span class="mx-2 slash">/</span>
                    <a href="#">Job</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Update Details</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">

        <div class="row align-items-center mb-5">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="d-flex align-items-center">
                    <div>
                        <h2>Update User details</h2>
                    </div>
                </div>
            </div>
        </div>
        @if (\Session::has('update'))
        <div class="alert alert-success">
            <p>{!! \Session::get('update') !!}</p>
        </div>
        @endif
        @if (\Session::has('error'))
        <div class="alert alert-success">
            <p>{!! \Session::get('error') !!}</p>
        </div>
        @endif
        <div class="row mb-5">
            <div class="col-lg-12">
                <form class="p-4 p-md-5 border rounded" action="{{ route('update.details') }}" method="post">
                    @csrf

                    <!--job details-->
                    <div class="form-group">
                        <label for="job-title">Name</label>
                        @if($errors->has('name'))
                        <p class="alert alert-warning">{{ $errors->first("name") }}</p>
                        @endif
                        <input type="text" value="{{ $userDetails->name }}" name="name" class="form-control" id="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="job_title">Job title</label>
                        @if($errors->has('job_title'))
                        <p class="alert alert-warning">{{ $errors->first("job_title")}}</p>
                        @endif
                        <input type="text" value="{{ $userDetails->job_title }}" name="job_title" class="form-control" id="job-title" placeholder="Job title">
                    </div>

                    <div class="form-group">
                        <label for="job_title">Facebook</label>
                        @if($errors->has('facebook'))
                        <p class="alert alert-warning">{{ $errors->first("facebook") }}</p>
                        @endif
                        <input type="text" value="{{ $userDetails->facebook }}" name="facebook" class="form-control" id="facebook" placeholder="facebook">
                    </div>

                    <div class="form-group">
                        <label for="job_title">Twitter</label>
                        @if($errors->has('twitter'))
                        <p class="alert alert-warning">{{ $errors->first("twitter") }}</p>
                        @endif
                        <input type="text" required value="{{ $userDetails->twitter }}" name="twitter" class="form-control" id="twitter" placeholder="Twitter">
                    </div>

                    <div class="form-group">
                        <label for="job_title">Linkedin</label>
                        @if($errors->has('linkedin'))
                        <p class="alert alert-warning">{{ $errors->first("linkedin") }}</p>
                        @endif
                        <input type="text" required value="{{ $userDetails->linkedin }}" name="linkedin" class="form-control" id="linkedin" placeholder="Linkedin">
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="bio">Bio</label>
                            @if($errors->has('bio'))
                            <p class="alert alert-warning">{{ $errors->first("bio") }}</p>
                            @endif
                            <textarea name="bio" required cols="30" rows="7" class="form-control" placeholder="Bio">{{$userDetails->bio}}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 ml-auto">
                        <div class="row">
                            <div class="col-6">
                                <input type="submit" name="submit" class="btn btn-block btn-primary btn-md" style="margin-left: 200px;" value="Update">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
@endsection