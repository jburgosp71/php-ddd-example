<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoPublished;

final class VideoPublishedMother
{
    public static function create(): VideoPublished
    {
        return new VideoPublished('20191111000000');
    }

    public static function random(): VideoPublished
    {
        return self::create();
    }
}
