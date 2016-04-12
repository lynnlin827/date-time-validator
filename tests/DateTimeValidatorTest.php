<?php

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DateTimeValidatorTest extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return ['DateTimeValidator\ValidatorServiceProvider'];
    }

    public function testDuringWithDefault()
    {
        Carbon::setTestNow(Carbon::createFromDate(2016, 02, 23));
        $validator = Validator::make(
            ['startAt' => '20160123'],
            ['startAt' => 'during']
        );
        $this->assertTrue($validator->passes());
    }

    public function testDuringWithYear()
    {
        Carbon::setTestNow(Carbon::createFromDate(2016, 02, 23));
        $validator = Validator::make(
            ['startAt' => '20150123'],
            ['startAt' => 'during:endAt,1Y', 'endAt' => 'string']
        );
        $this->assertFalse($validator->passes());
    }

    public function testDuringWithDay()
    {
        $validator = Validator::make(
            ['startAt' => '20150123', 'endAt' => '20150124'],
            ['startAt' => 'during:endAt,1d', 'endAt' => 'string']
        );
        $this->assertTrue($validator->passes());
    }

    public function testDuringWithWeek()
    {
        $validator = Validator::make(
            ['startAt' => '20150123', 'endAt' => '20150124'],
            ['startAt' => 'during:endAt,1w', 'endAt' => 'string']
        );
        $this->assertTrue($validator->passes());
    }

    public function testDuringMessage()
    {
        $validator = Validator::make(
            ['startAt' => '2015-01-23', 'endAt' => '2016-02-23'],
            ['startAt' => 'during:endAt,1Y', 'endAt' => 'string']
        );
        $this->assertEquals('The given time interval is longer than the specific period', $validator->messages()->getMessages()['startAt'][0]);
    }
}
