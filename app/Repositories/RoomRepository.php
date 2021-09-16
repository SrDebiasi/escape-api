<?php

namespace App\Repositories;

use App\Models\Info;
use App\Models\Room;
use App\Models\Timetable;
use App\Repositories\Interfaces\RoomRepositoryI;
use App\Repositories\Repository as BaseRepository;
use Illuminate\Support\Facades\DB;

class RoomRepository extends BaseRepository implements RoomRepositoryI
{
    /**
     * @index
     *
     * @param Array $input
     * @return Array
     */
    public function index($input)
    {

        //If available is true, need to return the available timetables of the actual date
        if (($input['available'] ?? false) && ($input['date'] ?? false)) {
            $rooms = Room::where('company_id', $input['company_id'])
                ->with([
                    'timetables.schedules' => function ($q) use ($input) {
                        $q->where('day', '=', $input['date']);
                        $q->when($input['ignore'] ?? null, function ($q, $v) {
                            $q->where('id', '!=', $v);
                        });
                    },

                    'timetables' => function ($q) use ($input) {
                        $data = \DateTime::createFromFormat('Y-m-d', $input['date']);
                        $q->where('enable', '=', true);
                        $q->where('days', 'LIKE', '%' . $data->format('w') . '%');
                        $q->orderBy('start');
                    },
                    'timetables.room'
                ])
                ->when($input['enable'] ?? null, function ($q, $v) {
                    $q->where('enable', $v);
                })->get();

            $info = Info::where(['id' => Info::INFO_ROOM_SIMULTANEOUS, 'company_id' => $input['company_id']])->first();
            $simultaneousRooms = true;
            $roomBusy = [];
            //In case of not simultaneous rooms, need to save if the room is busy
            if ($info && $info->value == 0) {
                $simultaneousRooms = false;
                foreach ($rooms as $room) {
                    foreach ($room->timetables as $timetable) {
                        foreach ($timetable->schedules as $schedule) {
                            $roomBusy[$timetable->start] = $schedule->id;
                        }
                    }
                }
            }

            foreach ($rooms as $room) {
                // First we need to check the type of the room, ticket or room type
                if ($room->schedule_type == Room::SCHEDULE_TYPE_TICKET) {
                    foreach ($room->timetables as $timetable) {
                        $occupiedVacancies = $timetable->schedules->sum('quantity');
                        $timetable->available = $room->vacancies > $occupiedVacancies;
                        $timetable->vacancies = $room->vacancies - $occupiedVacancies;
                        //Do not accept simultaneous, the time is busy and isn't this record
                        if (!$simultaneousRooms && isset($roomBusy[$timetable->start])) {
                            //Editing record, if isn't the itself, need to mark it busy and unavailable
                            if ($input['ignore'] ?? false && $roomBusy[$timetable->start] != $input['ignore']) {
                                $timetable->busy = true;
                                $timetable->available = false;
                            } else {
                                $timetable->busy = true;
                                $timetable->available = false;
                                $timetable->vacancies = 0;
                            }
                        }
                    }
                }

                if ($room->schedule_type == Room::SCHEDULE_TYPE_ROOM) {
                    foreach ($room->timetables as $timetable) {
                        $occupiedVacancies = $timetable->schedules->sum('quantity');
                        $timetable->available = $occupiedVacancies > 0;
                        $timetable->vacancies = $occupiedVacancies > 0 ? 0 : $room->vacancies;
                    }
                }
            }

            return $rooms;

        }

        $itens = Room::where('company_id', $input['company_id'])
            ->with([
                'timetables',
                'timetables.room'
            ])
            ->when($input['enable'] ?? null, function ($q, $v) {
                $q->where('enable', $v);
            })->get();

        return $itens;
    }


    /**
     * Show a resource
     * @param $id - show resource
     * @param $input - all from request
     * @return Room
     */
    public function show($id, $input)
    {
        $item = Room::with('timetables')->findOrFail($id);;
        return $item;
    }

    /**
     * Destroy the resource
     * @param $id - id to delete
     * @param $input -  all from request
     * @return boolean
     */
    public function destroy($id, $input)
    {
        return Room::findOrFail($id)->delete();
    }


    /**
     * Save the resource
     * @param $input
     * @return Room
     */
    public function store($input)
    {
        $item = new Room();
        $item->fill($input);
        $item->save();

        return $item;
    }

    /**
     * Update the resource
     * @param $id
     * @param $input
     * @return Room
     */
    public function update($id, $input)
    {
        $item = Room::findOrFail($id);
        if ($input['saveImage'] ?? null) {
            $file = $item['id'] . ".jpeg";
            $path = public_path() . '/img/rooms/' . $file;
            $base64_str = substr($input['picture_large'], strpos($input['picture_large'], ",") + 1);
            $image = base64_decode($base64_str);
            unset($input->picture_large);
            if (file_put_contents($path, $image))
                $input['picture_large'] = $file;
        }
        $item->fill($input);
        $item->save();

        return $item;
    }
}
