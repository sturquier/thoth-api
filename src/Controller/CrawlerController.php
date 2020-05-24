<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use App\Service\CrawlerFactory;
use App\Entity\Article;
use App\Entity\Website;

/**
 * @IsGranted("ROLE_USER")
 */
class CrawlerController extends AbstractController
{
    /**
     * Extracts & creates the collection of Article resources.
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/crawl")
     *
     * @SWG\Tag(name="Crawler")
     * @SWG\Parameter(
     *     name="website",
     *     in="body",
     *     description="The Website resource to be crawled.",
     *     @SWG\Schema(
     *         type="object",
     *         required={"slug"},
     *         @SWG\Property(property="slug", type="string")
     *     )
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Website successfully crawled."
     * )
     */
    public function crawlWebsite(Request $request, CrawlerFactory $crawlerFactory)
    {
        $em = $this->getDoctrine()->getManager();
        $website = $em->getRepository(Website::class)->findOneBy(['slug' => $request->request->get('slug')]);

        if (empty($website)) {
            return new JsonResponse(['message' => 'Website not found.'], Response::HTTP_NOT_FOUND);
        }

        $articles = $crawlerFactory::makeCrawler($website)->crawl();

        foreach ($articles ?? [] as $art) {
            $article = new Article(
                $art['title'],
                $art['description'],
                $art['createdAt'],
                $art['url'],
                $art['image']
            );

            $article->setWebsite($website);

            $em->persist($article);
            $em->flush();
        }

        return new JsonResponse(['message' => 'Website successfully crawled.'], Response::HTTP_CREATED);
    }
}
