<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryI;
use App\Repositories\Repository as BaseRepository;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class CompanyRepository extends BaseRepository implements CompanyRepositoryI
{
    /**
     * @index
     *
     * @param Array $input
     * @return Array
     */
    public function index($input)
    {
        return Company::all();
    }

    /**
     * @store
     *
     * @param Array $input
     * @return Company
     */
    public function store($input)
    {
        DB::beginTransaction();
        $item = new Company();
        $item->fill($input);
        $item->save();
        $item->users()->attach($input['user_id'], ['default' => true]);
        $item->save();
        DB::commit();

        return $item;
    }

    /**
     * @param $input
     * @return Company
     */
    public function update($input)
    {
        $item = Company::findOrFail($input['id']);
        $item->fill($input);
        $item->save();

        return $item;
    }
}
