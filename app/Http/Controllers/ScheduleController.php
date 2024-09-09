<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Schedule::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required',
        ]);
        if (Schedule::find($request->input('employee_id'))) {
            return response()->json([
                'error' => true,
                'message' => 'Schedule already exists!'
            ]);
        }
        try {
            $newSchedule = new Schedule();
            $newSchedule->employee_id = $request->input('employee_id');
            $newSchedule->mo_start = $request->input('mo_start');
            $newSchedule->mo_end = $request->input('mo_end');
            $newSchedule->tu_start = $request->input('tu_start');
            $newSchedule->tu_end = $request->input('tu_end');
            $newSchedule->we_start = $request->input('we_start');
            $newSchedule->we_end = $request->input('we_end');
            $newSchedule->th_start = $request->input('th_start');
            $newSchedule->th_end = $request->input('th_end');
            $newSchedule->fr_start = $request->input('fr_start');
            $newSchedule->fr_end = $request->input('fr_end');
            $newSchedule->sa_start = $request->input('sa_start');
            $newSchedule->sa_end = $request->input('sa_end');
            $newSchedule->su_start = $request->input('su_start');
            $newSchedule->su_end = $request->input('su_end');

            $newSchedule->save();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully created'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not create'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Schedule::where('employee_id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $schedule = Schedule::where('employee_id', $id)->first()->update($request->only(['mo_start','mo_end','tu_start','tu_end','we_start','we_end','th_start','th_end','fr_start','fr_end','sa_start','sa_end','su_start','su_end']));
            ;
            return response()->json([
                'error' => false,
                'message' => 'Succesfully edited'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not edit'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Schedule::where('employee_id', $id)->first()->delete();

            return response()->json([
                'error' => false,
                'message' => 'Succesfully deleted'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => 'Could not delete'
            ]);
        }
    }
}
