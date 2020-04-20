<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

abstract class BaseSeeder extends Seeder
{
    abstract public function dev();
    abstract public function production();

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $this->dev();
        } else if (App::environment('production')) {
            $this->production();
        }
    }
}
