<?php

declare(strict_types=1);

namespace Tests;

use Database\Seeds\Common\AreasTableSeeder;
use Database\Seeds\Common\OccupationsTableSeeder;
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
    }
}
