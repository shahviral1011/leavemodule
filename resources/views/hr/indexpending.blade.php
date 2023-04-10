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
                    <a class = "nav-link" href = "{{ route('home') }}"> Home  </a>  
                    </li>  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('approveleave') }}"> Approve  </a>  
                    </li>  
                    <li class = "nav-item">  
                    <a class = "nav-link" href = "{{ route('rejectedleave') }}"> Rejected </a>  
                    </li>  
                    </ul>  
                </nav>
                <div class="card-header"> Laeve List</div>

                <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                <thead class="bg-light">
                    <tr>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Shift Wise Leave</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Days</th>
                    <th>Reason</th>
                    <th>Rejection Reason</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                    <tr>
                    <td><p class="fw-bold mb-1">{{ $leave->users->name }}</p></td>
                    <td>
                        <div class="d-flex align-items-center">
                        <div>
                            @if($leave->leave_type == 'cl')
                            <p class="fw-bold mb-1">Casual Leave</p>
                            @elseif($leave->leave_type == 'sl')
                            <p class="fw-bold mb-1">Sick Leave</p>
                            @elseif($leave->leave_type == 'pl')
                            <p class="fw-bold mb-1">Paid Leave</p>
                            @elseif($leave->leave_type == 'lwp')
                            <p class="fw-bold mb-1">Leave Without Paid</p>
                            @endif
                            
                        </div>
                        </div>
                    </td>
                    <td>
                    @if($leave->leave_type_shift_wise == 'secondhalf')
                        <p class="fw-normal mb-1">Second-Half Day</p>
                    @elseif($leave->leave_type == 'firsthalf')
                        <p class="fw-normal mb-1">First-Half Day</p>
                    @else
                        <p class="fw-normal mb-1">Full Day</p>
                    @endif
                    </td>
                    <td>
                    @if($leave->status == 'pending')
                        <span class="fw-bold mb-1">Pending</span>
                    @elseif($leave->leave_type == 'approve')
                        <p class="fw-bold mb-1">Approved</p>
                    @else
                        <p class="fw-bold mb-1">Rejected</p>
                    @endif
                    </td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td><p class="fw-bold mb-1">{{ $leave->days }}</p></td>
                    <td>{{ $leave->emp_leave_reason }}</td>
                    <td>{{ $leave->rejection_reason }}</td>
                    <td><a class="btn btn-primary" href="{{ route('editstatus',encrypt($leave->id)) }}">Edit</a></td>
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
@push('script')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    
    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>
@endpush
