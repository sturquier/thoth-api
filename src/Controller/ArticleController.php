<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * Fetch all articles
     *
     * Return an array[] of articles order by creation date DESC
     *
     * @Rest\View(serializerGroups={"getArticles"})
     * @Rest\Get("/articles")
     * @SWG\Response(
     *     response=200,
     *     description="A filled array if there are articles or an empty one if there is none",
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
