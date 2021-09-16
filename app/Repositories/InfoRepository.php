<?php

namespace App\Repositories;

use App\Models\Info;
use App\Repositories\Interfaces\InfoRepositoryI;
use App\Repositories\Repository as BaseRepository;

class InfoRepository extends BaseRepository implements InfoRepositoryI
{
    /**
     * @index
     *
     * @param Array $input
     * @return Array
     */
    public function index($input)
    {
        $itens = Info::where('company_id', $input['company_id'])
            ->when($input['name'] ?? null, function ($q, $v) {
                $q->where('name', $v);
            })
            ->get();
        if (!count($itens) and $input['force'] === 'true') {
            $input['value'] = $input['default'] ?? 0;
            return $this->store($input);
        }


        return $itens;
    }


    /**
     * Show a resource
     * @param $id - show resource
     * @param $input - all from request
     * @return Info
     */
    public function show($id, $input)
    {
        return Info::findOrFail($id);
    }

    /**
     * Destroy the resource
     * @param $id - id to delete
     * @param $input -  all from request
     * @return boolean
     */
    public function destroy($id, $input)
    {
        return Info::findOrFail($id)->delete();
    }


    /**
     * Save the resource
     * @param $input
     * @return Info
     */
    public function store($input)
    {
        $item = new Info();
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
        $item = Info::findOrFail($id);
        $item->fill($input);
        $item->save();

        return $item;
    }
}
