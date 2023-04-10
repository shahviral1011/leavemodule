<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\UserTotalLeave;
use Auth;
use Carbon\Carbon;
use Helper;

class HrController extends Controller
{
    //
    public function pendingLeave()
    {   
        $leaves = LeaveRequest::with('users')->where('status','=','pending')->get();
        return view('hr.indexpending', compact('leaves'));
    }

    public function approveLeave()
    {   
        $leaves = LeaveRequest::with('users')->where('status','=','approve')->get();
        return view('hr.indexapprove', compact('leaves'));
    }

    public function rejectedLeave()
    {   
        $leaves = LeaveRequest::with('users')->where('status','=','reject')->get();
        return view('hr.indexreject', compact('leaves'));
    }

    public function editstatus($id){

        $ID = decrypt($id);
        $leaves  = LeaveRequest::findOrFail($ID);
        return view('hr.editstatus', compact('leaves'));
    }

    public function update(Request $request,$id){

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

        $totaldays = Helper::dayCount($request->start_date,$request->end_date,$request->shift_leave);

        $user = LeaveRequest::find($id);
        $user->user_id = $request->user_id;
        $user->leave_type = $request->leave_type;
        $user->leave_type_shift_wise = $request->shift_leave;
        $user->status = $request->status;
        $user->start_date =  $request->start_date;
        $user->end_date =  $request->end_date;
        $user->emp_leave_reason = $request->reason;
        $user->rejection_reason = $request->rejection_reason;
        $user->save();
        
        if($request->status == "reject"){
            $leave_deduction =  UserTotalLeave::where('user_id',$request->user_id)->first();
            
            if($request->leave_type == 'cl'){
                $updatedLeave = $leave_deduction->cl + $totaldays;
                UserTotalLeave::where('user_id',$request->user_id)->update(['cl' => $updatedLeave]);
            }
            if($request->leave_type == 'sl'){
                $updatedLeave = $leave_deduction->sl + $totaldays;
                UserTotalLeave::where('user_id',$request->user_id)->update(['sl' => $updatedLeave]);
            }
            if($request->leave_type == 'pl'){
                $updatedLeave = $leave_deduction->pl + $totaldays;
                UserTotalLeave::where('user_id',$request->user_id)->update(['pl' => $updatedLeave]);
            }
        }
       
        return redirect()->route('home')
        ->with('success','Leave Has Been updated successfully');
    }
}
