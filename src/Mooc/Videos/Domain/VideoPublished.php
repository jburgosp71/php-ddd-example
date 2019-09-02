<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\ValueObject\StringValueObject;
use DateTime;

final class VideoPublished extends StringValueObject
{
    public function __construct(string $initialDate = null)
    {
        if (is_null($initialDate))
        {
            $now = new DateTime();
            $initialDate = $now->format('YmdHis');
        }

        parent::__construct($initialDate);
    }
}
