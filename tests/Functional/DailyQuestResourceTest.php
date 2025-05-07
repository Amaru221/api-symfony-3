<?php

namespace App\Tests\Functional;

use DateTime;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class DailyQuestResourceTest extends ApiTestCase {

    use ResetDatabase;
    use Factories;

    public function testPatchCanUpdateStatus(){

        $yesterday = new DateTime('-1 day');

    }


}