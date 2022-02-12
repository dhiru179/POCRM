@extends('dashboardLayout')
@section('title', 'dashboard')
{{-- @section('dash', 'active') --}}
@section('dashboard_section')
    <h4>DashBoard</h4>
    @if (session()->has('error'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Message</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    @if (session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Message</strong> {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection
