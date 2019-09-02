<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoPublished;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateVideoCommandHandler implements CommandHandler
{
    private $creator;

    public function __construct(VideoCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateVideoCommand $command)
    {
        $id        = new VideoId($command->id());
        $type      = new VideoType($command->type());
        $title     = new VideoTitle($command->title());
        $url       = new VideoUrl($command->url());
        $courseId  = new CourseId($command->courseId());
        $published = new VideoPublished($command->published());

        $this->creator->create($id, $type, $title, $url, $courseId, $published);
    }
}
