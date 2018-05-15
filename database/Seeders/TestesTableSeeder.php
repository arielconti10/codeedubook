<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TestesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->command->info('seu fudido');

        // $this->call("OthersTableSeeder");
    }
}
