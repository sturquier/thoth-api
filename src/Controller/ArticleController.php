<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Article;

/**
 * @IsGranted("ROLE_USER")
 */
class ArticleController extends AbstractController
{
    /**
     * Retrieves the collection of Article resources.
     *
     * @Rest\View(serializerGroups={"getArticles"})
     * @Rest\Get("/articles")
     *
     * @SWG\Tag(name="Article")
     * @SWG\Response(
     *     response=200,
     *     description="Article collection response.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"getArticles"}))
     *     )
     * )
     */
    public function getArticles()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository(Article::class)->findBy([], ['createdAt' => 'DESC']);

        return $articles;
    }
}
