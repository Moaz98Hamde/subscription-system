@extends('layouts.admin.master', ['page' => 'Add new user'])

@section('content')
    <div class="row align-items-center">
        <div class="col-md-6 col-lg-7">
            <img src="{{ asset('vendors/images/register-page-img.png') }}" alt="" />
        </div>
        <div class="col-md-6 col-lg-5">
            @if (session()->has('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="register-box bg-white box-shadow border-radius-10">
                <div class="wizard-content">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-wrap max-width-600 mx-auto px-5 pt-5">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email Address*</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control @error('email') form-control-danger @enderror"
                                        name="email" value="{{old('email')}}"/>
                                    @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Name*</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('name') form-control-danger @enderror"
                                        name="name" value="{{old('name')}}"/>
                                    @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Password*</label>
                                <div class="col-sm-8">
                                    <input type="password"
                                        class="form-control @error('password') form-control-danger @enderror"
                                        name="password" />
                                    @error('password')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Confirm Password*</label>
                                <div class="col-sm-8">
                                    <input type="password"
                                        class="form-control @error('password_confirmation') form-control-danger @enderror"
                                        name="password_confirmation" />
                                    @error('password_confirmation')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="m-3 p-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
