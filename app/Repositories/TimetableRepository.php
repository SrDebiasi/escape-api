<?php

namespace App\Repositories;

use App\Models\Timetable;
use App\Models\Room;
use App\Repositories\Interfaces\TimetableRepositoryI;
use App\Repositories\Repository as BaseRepository;

class TimetableRepository extends BaseRepository implements TimetableRepositoryI
{
    /**
     * @index
     *
     * @param Array $input
     * @return Array
     */
    public function index($input)
    {

        $itens = Timetable::where('room_id', $input['room_id'])
            ->when($input['enable'] ?? null, function ($q, $v) {
                $q->where('enable', $v);
            })
            ->get();

        return $itens;
    }


    /**
     * Destroy the resource
     * @param $id - id to delete
     * @param $input -  all from request
     * @return boolean
     */
    public function destroy($id, $input)
    {
        return Timetable::findOrFail($id)->delete();
    }


    /**
     * Save the resource
     * @param $input
     * @return Timetable
     */
    public function store($input)
    {
        $item = new Timetable();
        $item->fill($input);
        $item->save();

        return $item;
    }

    /**
     * Update the resource
     * @param $id
     * @param $input
     * @return Timetable
     */
    public function update($id, $input)
    {
        $item = Timetable::findOrFail($id);
        $item->fill($input);
        $item->save();

        return $item;
    }
}
