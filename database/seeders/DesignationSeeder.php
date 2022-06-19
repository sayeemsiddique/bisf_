<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designations')->insert([
            'level'=>'4',
            'office_id'=>'2',
            'name'=>'Assitance Officer (Local)',
            'description'=>'Assitance Officer (Local)',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);

        DB::table('designations')->insert([
            'level'=>'4',
            'office_id'=>'2',
            'name'=>'Statistical Officer (Local)',
            'description'=>'Statistical Officer (Local)',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);

        DB::table('designations')->insert([
            'level'=>'1',
            'office_id'=>'1',
            'name'=>'Assitance Officer',
            'description'=>'Assitance Officer',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);

        DB::table('designations')->insert([
            'level'=>'1',
            'office_id'=>'1',
            'name'=>'Senior Programmer',
            'description'=>'Senior Programmer',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);

        DB::table('designations')->insert([
            'level'=>'1',
            'office_id'=>'1',
            'name'=>'Director',
            'description'=>'Director',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);
        
        DB::table('designations')->insert([
            'level'=>'1',
            'office_id'=>'1',
            'name'=>'Deputy Director General',
            'description'=>'Deputy Director General',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);

        DB::table('designations')->insert([
            'level'=>'1',
            'office_id'=>'1',
            'name'=>'Director General',
            'description'=>'Director General',
            'created_by'=>'1',
            'status'=>'1',
            'ordering'=>'1',
        ]);
        
    }
}
