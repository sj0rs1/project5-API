<?php

namespace App\Http\Controllers;

use App\Models\ScheduleException;
use Illuminate\Http\Request;

class ScheduleExceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ScheduleException::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

          $this->validate($request, [
        'date_start' => 'required|date',
        'date_end' => 'required|date',
        'new_start' => 'required',
        'new_end' => 'required',
          ]);
        try {
            $newScheduleException = new ScheduleException();
            $newScheduleException->employee_id = $request->input('employee_id');
            $newScheduleException->date_start = $request->input('date_start');
            $newScheduleException->date_end = $request->input('date_end');
            $newScheduleException->new_start = $request->input('new_start');
            $newScheduleException->new_end = $request->input('new_end');

            $newScheduleException->save();

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
        return ScheduleException::where('employee_id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            ScheduleException::find($id)->update($request->only(['employee_id', 'date', 'new_start', 'new_end']));
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
            ScheduleException::find($id)->delete();

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
