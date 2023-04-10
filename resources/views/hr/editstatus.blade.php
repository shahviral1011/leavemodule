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

                <form action="{{ route('statusupdate',$leaves->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" id="user_id" value="{{$leaves->user_id}}" name="user_id" class="form-control">
                    <div class="col col-mg-2" style="margin-left: 10px;"><strong>Leave Type:</strong></div>
                    <div class="col-md-9">
                        
                        <select class="form-select" aria-label="Default select example"  id="leave_type" name="leave_type">
                        <option value="">Select Type</option>
                        <option value="cl" {{ $leaves->leave_type=="cl" ? "selected" : ''}}>Casual Leave</option>
                        <option value="pl" {{ $leaves->leave_type=="pl" ? "selected" : ''}}>Paid Leave</option>
                        <option value="sl" {{ $leaves->leave_type=="sl" ? "selected" : ''}}>Sick Leave</option>
                        <option value="lwp" {{ $leaves->leave_type=="lwp" ? "selected" : ''}}>Leave Without Pay</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col col-mg-2" style="margin-left: 10px;"><strong>Select any one:</strong></div>
                    <div class="col-md-9">
                        
                        <select class="form-select" aria-label="Default select example"  id="shift_leave" name="shift_leave">
                        <option value="">Select Type</option>
                        <option value="firsthalf" {{ $leaves->leave_type_shift_wise=="firsthalf" ? "selected" : ''}}>First Half Leave</option>
                        <option value="secondhalf" {{ $leaves->leave_type_shift_wise=="secondhalf" ? "selected" : ''}}>Second Half Leave</option>
                        <option value="full" {{ $leaves->leave_type_shift_wise=="full" ? "selected" : ''}}>Full Day Leave</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col col-mg-2" style="margin-left: 10px;"><strong>Status:</strong></div>
                    <div class="col-md-9">
                        
                        <select class="form-select" aria-label="Default select example"  id="status" name="status">
                        <option value="">Chnage Status</option>
                        <option value="pending" {{ $leaves->status=="pending" ? "selected" : ''}}>Pending</option>
                        <option value="approve" {{ $leaves->status=="approve" ? "selected" : ''}}>Approve</option>
                        <option value="reject" {{ $leaves->status=="reject" ? "selected" : ''}}>Reject</option>
                        </select>
                    </div>
                   
                </div>

                <div class="row mt-3">
                    
                        <div class="col col-mg-2" style="margin-left: 10px;"><strong>Start Date:</strong></div>
                        <div class="col-md-9">
                            <input type="date" value="{{$leaves->start_date}}" id="start_date" class="form-control" name="start_date" placeholder="Select Date">
                        </div>
                    
                </div>
                <div class="row mt-3">
                    
                        <div class="col col-mg-2" style="margin-left: 10px;"><strong>End Date:</strong></div>
                        <div class="col-md-9">
                            <input type="date" value="{{$leaves->end_date}}" id="end_date" class="form-control" name="end_date" placeholder="Select Date">
                        </div>
                    
                </div>
                <div class="row mt-3">
                <div class="col col-mg-2" style="margin-left: 10px;"><strong>Reason:</strong></div>
                        <div class="col-md-9 mr-10">
                            <div class="form-group">
                                <input type="text" value="{{$leaves->emp_leave_reason}}" id="reason" name="reason" class="form-control" placeholder="Leave Reason">
                            </div>
                        </div>
                </div>
                <div class="row mt-3" id="rejectreason">
                <div class="col col-mg-2" style="margin-left: 10px;"><strong>Rejected Reason:</strong></div>
                        <div class="col-md-9 mr-10">
                            <div class="form-group">
                                <input type="text" value="{{$leaves->rejection_reason}}" id="rejection_reason" name="rejection_reason" class="form-control" placeholder="Leave Rejection Reason">
                            </div>
                        </div>
                </div>

                <div class="col-md-12 mt-3 mb-3" style="text-align: center;">
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
    $(document).ready(function () {
        $("#rejectreason").hide();
        $("#status").change(function() { 
            if ( $(this).val() == "reject") {
                $("#rejectreason").show();
            }
            else{
                $("#rejectreason").hide();
            }
        });
    });


</script>
@endpush