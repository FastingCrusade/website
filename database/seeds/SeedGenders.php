<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedGenders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            [
                'name' => 'male',
                'icon' => 'man icon',
            ],
            [
                'name' => 'female',
                'icon' => 'woman icon',
            ],
            [
                'name' => 'neuter',
                'icon' => 'neuter icon',
            ],
            [
                'name' => 'other',
                'icon' => 'other gender horizontal icon',
            ],
            [
                'name' => 'transgender',
                'icon' => 'transgender icon',
            ],
            [
                'name' => 'intergender',
                'icon' => 'intergender icon',
            ],
            [
                'name' => 'non-binary',
                'icon' => 'non binary transgender icon',
            ],
            [
                'name' => 'unknown',
                'icon' => 'genderless icon',
            ],
        ]);
    }
}
