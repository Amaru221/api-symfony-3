<?php

namespace App\Tests\Functional;

use App\Factory\DragonTreasureFactory;
use DateTime;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class DailyQuestResourceTest extends ApiTestCase {

    use ResetDatabase;
    use Factories;

    public function testPatchCanUpdateStatus(){

        DragonTreasureFactory::createMany(5);
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