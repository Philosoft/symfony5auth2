<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecialController extends AbstractController
{
  /**
   * @Route("/api/special", name="api_special")
   */
  public function apiSpecial(): Response
  {
    return $this->json([
      'message' => 'Welcome to your new controller!',
      'path' => 'src/Controller/SpecialController.php',
    ]);
  }

  /**
   * @Route("/special", name="special")
   */
  public function special(): Response
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    return $this->json([
      'message' => 'Special!',
      'path' => 'src/Controller/SpecialController.php',
    ]);
  }
}
