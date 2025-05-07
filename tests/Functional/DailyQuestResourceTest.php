<?php

namespace App\Tests\Functional;

use DateTime;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class DailyQuestResourceTest extends ApiTestCase {

    use ResetDatabase;
    use Factories;

    public function testPatchCanUpdateStatus(){

        $day = new DateTime('-2 day');

        $this->browser()
            ->patch('/api/quests/'.$day->format('Y-m-d'),
                [
                    'headers' => ['Content-Type' => 'application/merge-patch+json'],
                    'json' => [
                        'status' => 'completed'
                    ]
                ]
            )
            ->assertStatus(200)
            ->dump()
            ->assertJsonMatches('status', 'completed')
        ;
    }


}