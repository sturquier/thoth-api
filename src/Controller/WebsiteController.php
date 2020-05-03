<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Website;

/**
 * @IsGranted("ROLE_USER")
 */
class WebsiteController extends AbstractController
{
    /**
     * Retrieves the collection of Website resources.
     *
     * @Rest\View(serializerGroups={"getWebsites"})
     * @Rest\Get("/websites")
     *
     * @SWG\Tag(name="Website")
     * @SWG\Response(
     *     response=200,
     *     description="Website collection response.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Website::class, groups={"getWebsites"}))
     *     )
     * )
     */
    public function getWebsites()
    {
        $em = $this->getDoctrine()->getManager();
        $websites = $em->getRepository(Website::class)->findBy([], ['name' => 'ASC']);

        return $websites;
    }
}
