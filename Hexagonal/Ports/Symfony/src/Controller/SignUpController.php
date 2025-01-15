<?php

namespace SymfonyApp\Controller;

use Domains\User\SignUpService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SignUpController
{
    public function __construct(
        private readonly SignUpService  $signUpService
    )
    {
    }

    public function execute(
        Request $request,
    )
    {
        $postData = json_decode($request->getContent(), true);
        $email = $postData['email'];
        $password = $postData['password'];
        $name = $postData['name'];
        $phone = $postData['phone'];
        $source = 'Symfony App';
        try {
            $this->signUpService->execute($email, $password, $name, $phone, $source);
            return new JsonResponse(
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
            return new JsonResponse(
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