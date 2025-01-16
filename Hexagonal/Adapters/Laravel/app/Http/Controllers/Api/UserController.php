<?php
namespace LaravelApp\Http\Controllers\Api;

use Domains\User\SignUpService;
use Domains\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelApp\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $pageSize = $request->get('pageSize', 10);
        $paginator = $this->userService->paginate($page, $pageSize);
        return response()->json([
            'data' => $paginator->getData(),
            'meta' => [
                'current_page' => $paginator->getCurrentPage(),
                'per_page' => $paginator->getPerPage(),
                'total' => $paginator->getTotal()
            ]
        ]);
    }
}
