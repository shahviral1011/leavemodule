@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <nav class = "navbar bg-light navbar-expand-sm justify-content-center">  
                    <ul class = "navbar-nav">  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('pendingleave') }}"> Pending  </a>  
                    </li>  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('approveleave') }}"> Approve  </a>  
                    </li>  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('rejectedleave') }}"> Rejected </a>  
                    </li>  
                   
                    </ul>  
                </nav>
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
                    {{ __('You are logged in As A Admin!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
