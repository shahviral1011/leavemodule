@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <nav class = "navbar bg-light navbar-expand-sm justify-content-center">  
                    <ul class = "navbar-nav">  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('employee.index') }}"> Back  </a>  
                    </li>  
                    </ul>  
                </nav>
                <div class="card-header"> Available Leave List</div>
              
                <div class="card-body">
                
                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-6 col-md-3">
        <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Sick Leave</div>
        <div class="card-body text-primary">
            <h5 class="card-title">Un-used - {{$remain->sl}} Leave</h5>
            <p class="card-text">You can apply maximum 6 Leave per year.</p>
        </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Paid Leave</div>
        <div class="card-body text-primary">
            <h5 class="card-title">Un-used - {{$remain->pl}} Leave</h5>
            <p class="card-text">You can apply maximum 2 (cl or pl )Leave per month.</p>
        </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Casual Leave</div>
        <div class="card-body text-primary">
            <h5 class="card-title">Un-used - {{$remain->cl}} Leave</h5>
            <p class="card-text">You can apply maximum 2 (cl or pl )Leave per month.</p>
        </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-primary mb-3" style="max-width: 18rem;">
        <div class="card-header">Leave Without Pay</div>
        <div class="card-body text-primary">
            <h5 class="card-title">Used - {{$leavewp}} Leave</h5>
            <p class="card-text">You can apply unlimited Leave.</p>
        </div>
        </div>
    </div>
  </div>
</div>
@endsection
@push('script')

@endpush
