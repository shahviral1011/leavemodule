@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <nav class = "navbar bg-light navbar-expand-sm justify-content-center">  
                    <ul class = "navbar-nav">  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('employee.index') }}"> My Leave  </a>  
                    </li>  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('employee.create') }}"> Apply Leave  </a>  
                    </li>  
                   
                    </ul>  
                </nav>
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        <p>{{ $message }}</p>
                        </div>
                    @endif
                    {{ __('You are logged in as a Employee') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
