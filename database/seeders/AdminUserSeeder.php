<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserTotalLeave;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\UserTotalLeaveFactory;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->count(6)
        ->hasleaves(1) 
        ->create();

    }
}
