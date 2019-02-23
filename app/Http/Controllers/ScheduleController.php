<?php

namespace App\Http\Controllers;

use App\Schedule;
use Auth;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $validation = [
        "start_date" => "string|nullable",
        "end_date" => "string|nullable",
        "subjects" => "string|nullable|max:350",
        "start_time" => "string|nullable|max:10",
        "end_time" => "string|nullable|max:10",
        "room_id" => "required|integer",
        "requestedby" => "string|nullable|max:150",
        "leadby" => "string|nullable|max:150",
        "recordedby" => "string|nullable|max:50",
        "mr_id" => "integer|nullable",
        "num_member" => "string|nullable|max:50",
        "description" => "string|nullable|max:1000",
        "result" => "string|nullable",
        "recordedby" => "string|nullable|max:50",
        "status" => "integer|nullable",
        "status_comment" => "string|nullable|max:500",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Schedule::paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validation);
        $data['created_by'] = Auth::user()->id;
        $data['modified_by'] = Auth::user()->id;
        return Schedule::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Schedule::findOrFail($id);
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
        $schedule = Schedule::findOrFail($id);
        $data = $request->validate($this->validation);
        $data['modified_by'] = Auth::user()->id;
        $schedule->update($data);
        return $schedule;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete($data);
        return $schedule;
    }
}
