<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;
use DateTime;

final class VideoPublished extends StringValueObject
{
    public function __construct()
    {
        $now = new DateTime();

        parent::__construct($now->format('YmdHis'));
    }
}
