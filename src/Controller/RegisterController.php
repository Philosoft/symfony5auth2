<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class RegisterController extends AbstractController
{
  const HTTP_CONFLICT_CODE = 409;

  /**
   * @Route("/registration", name="registration")
   * @param Request $request
   * @param EntityManagerInterface $em
   * @param EncoderFactoryInterface $encoderFactory
   * @return JsonResponse
   */
  public function register(
    Request $request,
    EntityManagerInterface $em,
    EncoderFactoryInterface $encoderFactory
  ): JsonResponse
  {
    $userData = json_decode($request->getContent());

    if (!isset($userData) || !isset($userData->username) || !isset($userData->password)) {
      return $this->json(
        ['message' => 'Incorrect json'],
        self::HTTP_CONFLICT_CODE
      );
    }

    $userDB = $em->getRepository(User::class)->findBy(['username' => $userData->username]);
    if (count($userDB)) return $this->json(
      ['message' => 'Username already exists'],
      self::HTTP_CONFLICT_CODE
    );

    $user = new User();

    $username = $userData->username;
    $password = $encoderFactory->getEncoder($user)->encodePassword($userData->password, $user->getSalt());

    $user->setUsername($username);
    $user->setPassword($password);

    $em->persist($user);
    $em->flush();

    return $this->json([
      'message' => 'User is registered'
    ]);
  }
}
