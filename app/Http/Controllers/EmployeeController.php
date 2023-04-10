<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\UserTotalLeave;
use Auth;
use Helper;

class EmployeeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function remainLeave()
    {   
        $remain = UserTotalLeave::where('user_id',Auth::user()->id)->first();
        $leavewp = LeaveRequest::where('user_id',Auth::user()->id)
                ->where('status','=','approve')
                ->orWhere('status','=','pending')
                ->where('leave_type','=','lwp')
                ->sum('days');
       
        return view('employee.remainleave',compact('remain','leavewp'));
    }

    public function index()
    {   
        $leaves = LeaveRequest::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('employee.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'leave_type' => 'required',
            'shift_leave' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ], [
            'leave_type.required' => 'Leave Type field is required.',
            'shift_leave.required' => 'Shift Wise Leave field is required.',
            'start_date.required' => 'Start Date field is required.',
            'end_date.required' => 'End Date field is required.'
        ]);
        
        $checkData = Helper::checkLeaveConditions(Auth::user()->id,$request->start_date,$request->end_date,$request->shift_leave,$request->leave_type);

        $totaldays = Helper::dayCount($request->start_date,$request->end_date,$request->shift_leave);
        
        if($checkData == "saveLeave" || $checkData =="saveSickOrLwpLeave"){

            $user = new LeaveRequest;
            $user->user_id = Auth::user()->id;
            $user->leave_type = $request->leave_type;
            $user->leave_type_shift_wise = $request->shift_leave;
            $user->start_date = $request->start_date;
            $user->end_date = $request->end_date;
            $user->days = $totaldays;
            $user->emp_leave_reason = $request->reason;
            $user->save();

            $leave_deduction =  UserTotalLeave::where('user_id',Auth::user()->id)->first();
            
            if($request->leave_type == 'cl'){
                $updatedLeave = $leave_deduction->cl - $totaldays;
                UserTotalLeave::where('user_id',Auth::user()->id)->update(['cl' => $updatedLeave]);
            }
            if($request->leave_type == 'sl'){
                $updatedLeave = $leave_deduction->sl - $totaldays;
                UserTotalLeave::where('user_id',Auth::user()->id)->update(['sl' => $updatedLeave]);
            }
            if($request->leave_type == 'pl'){
                $updatedLeave = $leave_deduction->pl - $totaldays;
                UserTotalLeave::where('user_id',Auth::user()->id)->update(['pl' => $updatedLeave]);
            }
            
           
        }elseif($checkData == "moreThenTwoLeaveSameMonth"){
            return redirect()->back()->with('error', "Do not take more then 2 sick leave or paid leave in same month.");
        }elseif($checkData == "useUnpaidLeave"){
            return redirect()->back()->with('error', "Please Use Unpaid Leave.");
        }elseif($checkData == "moreThansixLeave"){
            return redirect()->back()->with('error', "Do not apply more than six sick leave.");
        }
        
        return redirect()->route('employee.index')->with('success', 'Employee Leave created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
