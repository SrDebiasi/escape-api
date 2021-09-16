<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idUser = DB::table('user')->insertGetId([
            'name' => Str::random(10),
            'email' => '2@2.com',
            'enable' => true,
            'password' => Hash::make('1'),
        ]);
        $idCompany = DB::table('company')->insertGetId([
            'name' => Str::random(10),
            'email' => '2@2.com',
        ]);

        DB::table('user_company')->insert([
            'company_id' => $idCompany,
            'user_id' => $idUser,
            'default' => true
        ]);

    }
}
