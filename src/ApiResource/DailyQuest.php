<?php 

namespace App\ApiResource;

use DateTimeInterface;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use App\Enum\DailyQuestStatusEnum;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\State\DailyQuestStateProvider;
use ApiPlatform\Metadata\GetCollection;
use App\State\DailyQuestStateProcessor;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ApiResource(
    shortName: 'Quest',
    provider: DailyQuestStateProvider::class,
    operations: [
        new GetCollection(),
        new Get(),
        new Patch(),
    ],
    processor: DailyQuestStateProcessor::class
)]
class DailyQuest{

    #[Ignore]
    public \DateTimeInterface $day;

    public string $questName;
    public string $description;
    public int $difficultyLevel;
    public DailyQuestStatusEnum $status;

    public function __construct(DateTimeInterface $day){
        $this->day = $day;
    }

    #[ApiProperty(readable: false, identifier: true)]
    public function getDayString(): string
    {
        return $this->day->format('Y-m-d');
    }

}