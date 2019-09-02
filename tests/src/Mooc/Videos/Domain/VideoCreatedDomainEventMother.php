<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoPublished;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Test\Mooc\Shared\Domain\Courses\CourseIdMother;
use CodelyTv\Test\Mooc\Shared\Domain\Videos\VideoUrlMother;

final class VideoCreatedDomainEventMother
{
    public static function create(
        VideoId $id,
        VideoType $type,
        VideoTitle $title,
        VideoUrl $url,
        CourseId $courseId,
        VideoPublished $published
    ): VideoCreatedDomainEvent {
        return new VideoCreatedDomainEvent(
            $id->value(),
            [
                'type'     => $type->value(),
                'title'    => $title->value(),
                'url'      => $url->value(),
                'courseId' => $courseId->value(),
                'published' => $published->value(),
            ]
        );
    }

    public static function random(): VideoCreatedDomainEvent
    {
        return self::create(
            VideoIdMother::random(),
            VideoTypeMother::random(),
            VideoTitleMother::random(),
            VideoUrlMother::random(),
            CourseIdMother::random(),
            VideoPublishedMother::random()
        );
    }
}
