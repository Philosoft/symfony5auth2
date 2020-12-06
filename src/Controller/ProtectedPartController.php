<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class ProtectedPartController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function protectedZone(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return new JsonResponse([
            'message' => 'if you can see this, then your token is correct',
            'username' => $this->security->getUser()->getUsername(), // there always will be a user, since we guard with denyAccessUnlessGranted
        ]);
    }
}
