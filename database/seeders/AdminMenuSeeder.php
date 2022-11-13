<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
            'parent_id' => 0,
            'order' => 0,
            'title' => 'Tickets',
            'icon' => 'fa-pencil-square-o',
            'uri' => '/tickets'
        ]);
    }
}
