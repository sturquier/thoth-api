<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use App\Entity\Website;

class WebsiteController extends AbstractController
{
    /**
     * Fetch all websites
     *
     * Return an array[] of websites order by alphabetical name (ASC)
     *
     * @Rest\Get("/websites")
     * @SWG\Response(
     *     response=200,
     *     description="A filled array if there are websites or an empty one if there is none"
     * )
     */
    public function getWebsites()
    {
        $em = $this->getDoctrine()->getManager();
        $websites = $em->getRepository(Website::class)->findBy([], ['name' => 'ASC']);

        return $websites;
    }
}
