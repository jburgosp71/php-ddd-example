<?php

declare(strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\Video;

use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommand;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Api\Controller\ApiController;
use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpCreatedResponse;
use Symfony\Component\HttpFoundation\Request;

final class VideoPostController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request)
    {
        $command = new CreateVideoCommand(
            new Uuid($request->get('request_id')),
            $request->get('id'),
            $request->get('type'),
            $request->get('title'),
            $request->get('url'),
            $request->get('course_id'),
            $request->get('published')
        );

        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }
}
