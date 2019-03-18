<?php

namespace Tests;

use Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $mockConsoleOutput = false;

    public function setUp():void
    {
        parent::setUp();
//        Artisan::call('migrate',['-vvv' => true]);
//        Artisan::call('db:seed',['-vvv' => true]);
//        Artisan::call('passport:client', ['--password' => null, '--no-interaction' => true]);
//        Artisan::call('passport:keys', ['--no-interaction' => true, '--force' => true]);

    }
}
