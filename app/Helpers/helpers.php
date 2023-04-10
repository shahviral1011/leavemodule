<?php
namespace App\Helpers;
use App\Models\Cart;
use Auth;
use Carbon\Carbon;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Models\UserTotalLeave;

class Helper {
    /*** change date format ***/
    
    public static function checkLeaveConditions($user_id,$start_date,$end_date,$shift_leave,$leave_type) {
            $startDate = Carbon::parse($start_date);
            $endDate = Carbon::parse($end_date);
            
            $leaveStatus = self::availableLeave($user_id,$leave_type);
            if($leaveStatus == "Available"){
                $startDatemonth = date('m', strtotime($start_date));
                $endDatemonth = date('m', strtotime($end_date));

                $startDateCount = self::startDateMonthWiseLeave($startDatemonth,$user_id);
                $endDateCount = self::startDateMonthWiseLeave($endDatemonth,$user_id);
                $LeaveDays = self::dayCount($start_date,$end_date,$shift_leave);
                
                if($LeaveDays < 7 && $leave_type == "sl"){
                    return "saveSickOrLwpLeave";
                }elseif($leave_type == "lwp"){
                    return "saveSickOrLwpLeave";
                }elseif($LeaveDays > 7 && $leave_type == "sl"){
                    return "moreThansixLeave";
                }
                if (($startDateCount != 0) && ($endDateCount != 0) && ($startDateCount == $endDateCount)){
                    if($startDateCount < 2){
                        $total = $startDateCount + $LeaveDays;
                        if($total >= 2){
                            return "moreThenTwoLeaveSameMonth";
                        } 
                    }else{
                        return "moreThenTwoLeaveSameMonth";
                    }
                }else{
                    
                    if(($startDateCount == 0 && $endDateCount == 0) || ($startDateCount < 2 && $endDateCount < 2)){
                        $totalStartMonth = $startDateCount + $LeaveDays;
                        $totalEndtMonth = $endDateCount + $LeaveDays;
                        
                        if($LeaveDays == 4 && ($totalStartMonth > 2 || $totalEndtMonth > 2)){
                            return "moreThenTwoLeaveSameMonth";
                        } 
                    }else{
                        return "moreThenTwoLeaveSameMonth";
                    }  
                }
            }else{
                return "useUnpaidLeave";
            }

        return "saveLeave";
    }
    
    
    public static function dayCount($start_date,$end_date,$shift_leave) {
       
        $startDate = Carbon::parse($start_date);
        $endDate = Carbon::parse($end_date);

        $diffInDays = $startDate->diffInDays($endDate);

        if($diffInDays == 0 && $shift_leave == "full"){
            $diffInDays = $diffInDays + 1;
        }elseif($diffInDays == 0 && ($shift_leave == "firsthalf" || $shift_leave == "secondhalf")){
            $diffInDays = $diffInDays + 0.5;
        }elseif($diffInDays > 0 && $shift_leave == "full"){
            $diffInDays = $diffInDays + 1;
        }elseif($diffInDays > 0 && ($shift_leave == "firsthalf" || $shift_leave == "secondhalf")){
            $diffInDays = $diffInDays + 0.5;
        }
        return $diffInDays;
    
    }

    
    public static function availableLeave($user_id,$leave_type) {
       
        $leave = 'NotAvailable';
        if($leave_type != "lwp"){
                $UserLeaveData = UserTotalLeave::select($leave_type)->where('user_id','=',$user_id)->first();

                if($UserLeaveData->cl != 0){
                    $leave = 'Available';
                }
                if($UserLeaveData->sl != 0){
                    $leave = 'Available';
                }
                if($UserLeaveData->pl != 0){
                    $leave = 'Available';
                }
        }
       
        if($leave_type == "lwp"){
            $leave = 'Available';
        }
        return $leave;
    }

    public static function startDateMonthWiseLeave($startDatemonth,$user_id) {
       
        $startMonthLeave = LeaveRequest::where('user_id','=',$user_id)
                            ->whereMonth('start_date', $startDatemonth)
                            ->where('leave_type','=','cl')
                            ->orWhere('leave_type','=','pl')->sum('days');
        return $startMonthLeave;
    
    }

    public static function endDateMonthWiseLeave($endDatemonth,$user_id) {
       
        $endMonthLeave = LeaveRequest::where('user_id','=',$user_id)
                            ->whereMonth('end_date', $endDatemonth)
                            ->where('leave_type','=','cl')
                            ->orWhere('leave_type','=','pl')->sum('days');
        return $endMonthLeave;
    
    }
}