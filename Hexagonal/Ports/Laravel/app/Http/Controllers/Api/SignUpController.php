<?php
namespace LaravelApp\Http\Controllers\Api;

use Domains\User\SignUpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelApp\Http\Controllers\Controller;

class SignUpController extends Controller
{
    public function __construct(
        private readonly SignUpService $signUpService
    )
    {
    }

    /**
     * @return void
     */
    public function execute(Request $request): JsonResponse
    {
        /**
         * TODO: This is where non-business concerns code live
         */
        $postData = $request->all();
        $email = $postData['email'];
        $password = $postData['password'];
        $name = $postData['name'];
        $phone = $postData['phone'];
        $source = 'Laravel App';
        try {
            $this->signUpService->execute(
                $email, $password, $name, $phone, $source
            );
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sign up successful',
                    'data' => [
                        'email' => $email,
                        'name' => $name,
                        'phone' => $phone,
                        'source' => $source
                    ]
                ]
            );
        } catch (\Throwable $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'data' => [
                        'email' => $email,
                    ]
                ],
                $exception->getCode()
            );
        }
    }
}
