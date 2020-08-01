<?php

namespace Tests;

use Database\Seeds\Common\AreasTableSeeder;
use Database\Seeds\Common\OccupationsTableSeeder;
use Database\Seeds\Common\PrefecturesTableSeeder;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh');

        $this->seed(AreasTableSeeder::class);
        $this->seed(OccupationsTableSeeder::class);
        $this->seed(PrefecturesTableSeeder::class);
    }
}
