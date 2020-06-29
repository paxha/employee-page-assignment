<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Employee::class, 10)->create()->each(function ($employee) {
            $employee->shifts()->attach(\App\Shift::all()->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
