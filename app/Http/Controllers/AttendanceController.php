<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Models\Attendance;
use Carbon\Carbon;
use Modules\Common\Models\Partner;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Get authenticated user's partner ID
        $id = auth()->user()->id;

        $partnerId = Partner::where('user_id', $id)->pluck('id')->first();


        // Get optional search term, start and end date
        $searchTerm = $request->query('search');
        $startDate = $request->query('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->query('end_date', Carbon::now()->endOfMonth()->toDateString());

        // Validate the date range
        if (Carbon::parse($startDate)->gt(Carbon::parse($endDate))) {
            return response()->json(['error' => 'Invalid date range'], 400);
        }

        // Fetch attendance data with pagination, filter by date range and search term
        $attendanceQuery = Attendance::with('partner')->where('partner_id', $partnerId)
            ->whereBetween('attendance_date', [$startDate, $endDate]);

        // If search term is provided, filter by it (e.g., match location or status)
        if ($searchTerm) {
            $attendanceQuery->where(function ($query) use ($searchTerm) {
                $query->where('location', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('status', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Paginate results
        $attendance = $attendanceQuery->orderBy('attendance_date', 'desc')->paginate(10);

        // Return paginated data
        return response()->json($attendance);
    }


    public function checkStatus(Request $request)
    {
        // Get the authenticated user's partner ID
        $id = auth()->user()->id;

        $partnerId = Partner::where('user_id', $id)->pluck('id')->first();

        // Fetch attendance data for the user
        $attendance = Attendance::where('partner_id', $partnerId)
            ->whereDate('attendance_date', now()->toDateString())
            ->first();

        // Prepare response data
        $isCheckedIn = $attendance ? true : false;
        $isCheckedOut = $attendance && $attendance->check_out_time ? true : false; // Assuming `check_out_time` is the field for check-out

        // Return the response based on the attendance status
        return response()->json([
            'is_checked_in' => $isCheckedIn,
            'is_checked_out' => $isCheckedOut, // Include checked-out status
            'attendance_date' => $attendance ? $attendance->attendance_date : null,
            'location' => $attendance ? $attendance->location : null,
            // 'check_out_time' => $attendance ? $attendance->check_out_time : null, // Return check-out time if available
        ]);
    }



    public function submitCheckIn(Request $request)
    {
        $request->validate([
            'location' => 'nullable|string|max:255',
        ]);

        $today = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('partner_id', $request->partner_id)
            ->where('attendance_date', $today)
            ->first();

        if ($attendance && $attendance->check_in_time !== null) {
            return response()->json(['message' => 'You have already checked in today.'], 400);
        }

        if ($attendance) {
            $attendance->check_in_time = Carbon::now()->format('H:i:s');
            $attendance->location = $request->location;
            $attendance->status = 'present'; // Set to present on check-in
            $attendance->save();
        } else {
            Attendance::create([
                'partner_id' => $request->partner_id,
                'attendance_date' => $today,
                'check_in_time' => Carbon::now()->format('H:i:s'),
                'location' => $request->location,
                'status' => 'present', // Default status
            ]);
        }

        return response()->json(['message' => 'Check-in recorded successfully.'], 200);
    }

    public function submitCheckOut(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
        ]);

        $today = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('partner_id', $request->partner_id)
            ->where('attendance_date', $today)
            ->first();

        // Check if user has already checked out for the day
        if ($attendance && $attendance->check_out_time !== null) {
            return response()->json(['message' => 'You have already checked out today.'], 400);
        }

        // Update check-out time
        if ($attendance) {
            $attendance->check_out_time = Carbon::now()->format('H:i:s');
            $attendance->save();
            return response()->json(['message' => 'Check-out recorded successfully.'], 200);
        }

        return response()->json(['message' => 'You need to check in before checking out.'], 400);
    }
}
