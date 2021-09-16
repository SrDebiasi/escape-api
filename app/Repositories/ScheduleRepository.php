<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Models\Timetable;
use App\Repositories\Interfaces\ScheduleRepositoryI;
use App\Repositories\Repository as BaseRepository;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ScheduleRepository extends BaseRepository implements ScheduleRepositoryI
{
    /**
     * @index
     *
     * @param Array $input
     * @return Array
     */
    public function index($input)
    {
        $itens = Schedule::with([
            'timetable.room' => function ($q) use ($input) {
                $q->where('company_id', '=', $input['company_id']);
            },
            'user.companies'])
            ->when($input['range'] ?? null, function ($q, $v) {
                if ($v == 'last7days') {
                    $q->whereDate('day', '>=', Carbon::now()->subDays(7));
                    $q->whereDate('day', '<=', Carbon::now());
                }
                if ($v == 'next7days') {
                    $q->whereDate('day', '>=', Carbon::now());
                    $q->whereDate('day', '<=', Carbon::now()->addDays(7));
                }
                if ($v == 'this-month') {
                    $q->whereDate('day', '>=', Carbon::now()->firstOfMonth());
                    $q->whereDate('day', '<=', Carbon::now()->lastOfMonth());
                }
            })
            ->orderBy('day', 'desc')
            ->get();

        return $itens;
    }


    /**
     * Show a resource
     * @param $id - show resource
     * @param $input - all from request
     * @return Array
     */
    public function show($id, $input)
    {
        $item = Schedule::with(['timetable.room'])->findOrFail($id);;
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
        return Schedule::findOrFail($id)->delete();
    }


    /**
     * Save the resource
     * @param $input
     * @return Array
     */
    public function store($input)
    {
        //Before save we need to do all the room verifications involved
        $roomRepository = new RoomRepository();
        $room = Timetable::with('room')->findOrFail($input['timetable_id'])->room;
        $availableRooms = $roomRepository->index(
            ['available' => true,
                'date' => $input['day'],
                'company_id' => $room->company_id,
                'ignore' => $input['id'] ?? null
            ]);

        $actualRoom = $availableRooms->firstWhere('id', $room->id);
        $actualTimetable = $actualRoom->timetables->firstWhere('id', $input['timetable_id']);

        if (!$actualTimetable->available || $actualTimetable->vacancies < $input['quantity'])
            return $this->response(['message' => 'schedule.messages.error.no_vacancies'], Response::HTTP_NOT_ACCEPTABLE);

        $item = new Schedule();
        $item->fill($input);
        $item->save();

        return $item;
    }

    /**
     * Update the resource
     * @param $id
     * @param $input
     * @return Array
     */
    public function update($id, $input)
    {
        $item = Schedule::findOrFail($id);
        $item->fill($input);
        $item->save();

        return $item;
    }
}
