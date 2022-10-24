@extends('layouts.website.master', ['page' => 'Subscibed'])

@push('styles')
    <style>
        h1{
            min-height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="container px-0">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">
                    You are subscribed Member 🔥
                </h1>
            </div>
        </div>
    </div>
@endsection
