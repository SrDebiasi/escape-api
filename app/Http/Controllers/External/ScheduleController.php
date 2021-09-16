<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Http\Requests\External\ScheduleRequest;
use App\Models\Info;
use App\Models\Room;
use App\Models\Timetable;
use App\Repositories\Interfaces\ScheduleRepositoryI;


class ScheduleController extends Controller
{
    protected $scheduleRepository;

    /**
     * Construct the controller.
     *
     * @param ScheduleRepositoryI $scheduleRepository
     * @return void
     */
    function __construct(ScheduleRepositoryI $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $input = $request->all();
        $room = Timetable::with('room')->findOrFail($input['timetable_id'])->room;
        $price = 0;

        if ($room->schedule_type == Room::SCHEDULE_TYPE_TICKET) $price = $room->ticket_price * $input['quantity'];
        if ($room->schedule_type == Room::SCHEDULE_TYPE_ROOM) $price = $room->room_price;

        $info = Info::where(['id' => Info::INFO_SCHEDULE_NEW_CONFIRMED_DEFAULT, 'company_id' => $room->company_id])->first();

        $request->merge([
            'company_id' => $room->company_id,
            'payment_value' => $price,
            'confirmed' => $info->value == 1
        ]);
        $response = $this->scheduleRepository->store($request->all());

        return $this->response($response);
    }


}
