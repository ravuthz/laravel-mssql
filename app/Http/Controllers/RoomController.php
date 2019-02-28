<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use App\Room;
use Auth;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $validation = [
        "room_name" => "required|string|max:50",
        "room_type" => "required|string|max:50",
        "num_member" => "required|integer|max:9999",
        "equipment" => "required|string|max:500",
        "description" => "required|string|max:500",
    ];

    private function findOrFail($id)
    {
        $room = Room::where('isdeleted', 0)->findOrFail($id);
        return new RoomResource($room);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with('schedules')->where('isdeleted', 0)->paginate(20);
        return new RoomCollection($rooms);
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
        $data['modified_by'] = Auth::user()->id;
        $data['isdeleted'] = 0;
        return Room::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->findOrFail($id);
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
        $room = $this->findOrFail($id);
        $data = $request->validate($this->validation);
        $data['modified_by'] = Auth::user()->id;
        $room->update($data);
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = $this->findOrFail($id);
        $data = ['isdeleted' => 1];
        $data['modified_by'] = Auth::user()->id;
        $room->update($data);
        return $room;
    }
}
