<?php

namespace App\Controller;

use Safe\Exceptions\JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController  extends AbstractController
{
    /**
     * @Route("/{vueRouting}", requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"}, name="index")
     * @return Response
     * @throws JsonException
     */
    public function number(): Response
    {
        return $this->render('base.html.twig');
    }
}
