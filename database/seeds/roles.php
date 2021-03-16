<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('permissions')->insert([
             'name' => 'Create-Users',
             'display_name' =>"Create users",
             'description' => "Create new users",
         ]);

        DB::table('permissions')->insert([
            'name' => 'Edit-Users',
            'display_name' =>"Edit users",
            'description' => "Edit this users",
        ]);

        DB::table('permissions')->insert([
            'name' => 'Delete-Users',
            'display_name' =>"Delte users",
            'description' => "Delete a users",
        ]);



    }
}
