@extends('layouts.app')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <nav class = "navbar bg-light navbar-expand-sm justify-content-center">  
                    <ul class = "navbar-nav">  
                    
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('employee.index') }}"> Back  </a>  
                    </li>  
                   
                    </ul>  
                </nav>
                

                <div class="card-body">
                @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                <p>{{ $message }}</p>
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif  
                </div>

                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col col-mg-2" style="margin-left: 10px;"><strong>Leave Type:</strong></div>
                    <div class="col-md-9">
                        
                        <select class="form-select" aria-label="Default select example"  id="leave_type" name="leave_type">
                        <option value="">Select Type</option>
                        <option value="cl">Casual Leave</option>
                        <option value="pl">Paid Leave</option>
                        <option value="sl">Sick Leave</option>
                        <option value="lwp">Leave Without Pay</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col col-mg-2" style="margin-left: 10px;"><strong>Select any one:</strong></div>
                    <div class="col-md-9">
                        
                        <select class="form-select" aria-label="Default select example"  id="shift_leave" name="shift_leave">
                        <option value="">Select Type</option>
                        <option value="firsthalf">First Half Leave</option>
                        <option value="secondhalf">Second Half Leave</option>
                        <option value="full">Full Day Leave</option>
                        </select>
                    </div>
                   
                </div>
                <div class="row mt-3">
                    
                        <div class="col col-mg-2" style="margin-left: 10px;"><strong>Start Date:</strong></div>
                        <div class="col-md-9">
                            <input type="datetime-local" id="start_date" class="form-control" name="start_date" placeholder="Select Date">
                        </div>
                    
                </div>
                <div class="row mt-3">
                    
                        <div class="col col-mg-2" style="margin-left: 10px;"><strong>End Date:</strong></div>
                        <div class="col-md-9">
                            <input type="datetime-local" id="end_date" class="form-control" name="end_date" placeholder="Select Date">
                        </div>
                    
                </div>
                <div class="row mt-3">
                <div class="col col-mg-2" style="margin-left: 10px;"><strong>Reason:</strong></div>
                        <div class="col-md-9 mr-10">
                            <div class="form-group">
                                <input type="text" id="reason" name="reason" class="form-control" placeholder="Leave Reason">
                            </div>
                        </div>
                </div>
                <div class="col-md-12 mt-3" style="text-align: center;">
                <button type="submit" class="btn-sm btn-primary ml-3">Submit</button>
                </div>
                
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=datetime-local]");
</script>
@endpush