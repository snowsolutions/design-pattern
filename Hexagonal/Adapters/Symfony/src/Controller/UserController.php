<?php

declare(strict_types=1);

namespace SymfonyApp\Controller;

use Domains\User\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{

    public function __construct(
        private readonly UserService $userService,
        private readonly SerializerInterface $serializer,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        $page = (int) $request->get('page', 1);
        $pageSize = (int) $request->get('pageSize', 10);
        $paginator = $this->userService->paginate($page, $pageSize);
        return $this->json([
            'data' => $this->serializer->normalize(data: $paginator->getData(), context: [AbstractObjectNormalizer::SKIP_UNINITIALIZED_VALUES => false]),
            'meta' => [
                'current_page' => $paginator->getCurrentPage(),
                'per_page' => $paginator->getPerPage(),
                'total' => $paginator->getTotal()
            ]
        ]);
    }
}
