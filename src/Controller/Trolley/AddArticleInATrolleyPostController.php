<?php

namespace App\Controller\Trolley;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;

use Domain\ArticleInTrolleyArticleId;
use Domain\ArticleInTrolleyId;
use Domain\ArticleInTrolleyTrolleyId;
use Domain\ArticleInTrolleyUnits;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddArticleInATrolleyPostController extends AbstractController
{
    public function __construct(private readonly CommandBus $commandBus){

    }

    public function __invoke(string $trolleyId, Request $request): JsonResponse
    {
        try{
            $data = $request->toArray();
            $this->commandBus->dispatch(
                \CreateArticleInTrolleyCommand::create(
                    new ArticleInTrolleyId(Uuid::random()),
                    new ArticleInTrolleyArticleId($data['articleId']),
                    new ArticleInTrolleyTrolleyId($trolleyId),
                    new ArticleInTrolleyUnits($data['units'])
                )
            );

            return new JsonResponse('Article add to trolley properly.');

        } catch (\Exception $e){
            throw new \Exception('Article couldn\'t be add into the trolley: ' . $e->getMessage());
        }
    }
}