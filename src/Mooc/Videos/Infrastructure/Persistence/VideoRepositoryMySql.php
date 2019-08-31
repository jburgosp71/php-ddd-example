<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Infrastructure\Persistence;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\Videos;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;
use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Shared\Domain\Criteria\OrderType;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineCriteriaConverter;
use CodelyTv\Shared\Infrastructure\Doctrine\DoctrineRepository;

final class VideoRepositoryMySql extends DoctrineRepository implements VideoRepository
{
    private static $criteriaToDoctrineFields = [
        'id'        => 'id',
        'type'      => 'type',
        'title'     => 'title',
        'url'       => 'url',
        'course_id' => 'courseId',
    ];

    public function save(Video $video): void
    {
        $this->persist($video);
    }

    public function search(VideoId $id): ?Video
    {
        return $this->repository(Video::class)->find($id);
    }

    public function searchLastPublished(): ?Video
    {
        $orderBy = new OrderBy("id");
        $orderType = new OrderType("desc");
        $order = new Order($orderBy, $orderType);
        $filters = Filters::fromValues(array());
        $criteria = new Criteria($filters, $order, null, null);

        $videos = $this->searchByCriteria($criteria);

        return $videos->getIterator()->current();
    }

    public function searchByCriteria(Criteria $criteria): Videos
    {
        $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria, self::$criteriaToDoctrineFields);
        $videos           = $this->repository(Video::class)->matching($doctrineCriteria)->toArray();

        return new Videos($videos);
    }
}
