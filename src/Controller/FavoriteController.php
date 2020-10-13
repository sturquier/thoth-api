<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Form\FavoriteType;
use App\Entity\Favorite;
use App\Entity\Article;

/**
 * @IsGranted("ROLE_USER")
 */
class FavoriteController extends AbstractController
{
    /**
     * Creates / removes a Favorite resource.
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"createFavorite"})
     * @Rest\Post("/favorites")
     *
     * @SWG\Tag(name="Favorite")
     * @SWG\Parameter(
     *     name="favorite",
     *     in="body",
     *     description="The Favorite resource.",
     *     @Model(type=FavoriteType::class)
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Favorite resource created.",
     *     @SWG\Schema(
     *         ref=@Model(type=Favorite::class, groups={"createFavorite"})
     *     )
     * )
     * @SWG\Response(
     *     response=204,
     *     description="Favorite resource deleted."
     * )
     */
    public function createOrRemoveFavorite(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $foundFavorite = $em->getRepository(Favorite::class)->findOneBy([
            'article' => $em->getRepository(Article::class)->find($request->request->get('article')),
            'user' => $this->getUser()
        ]);

        if (!is_null($foundFavorite)) {
            $em->remove($foundFavorite);
            $em->flush();

            return new JsonResponse(['message' => 'Favorite successfully deleted.'], Response::HTTP_NO_CONTENT);
        }

        $favorite = new Favorite($this->getUser());

        $form = $this->createForm(FavoriteType::class, $favorite);
        $form->submit([
            'article' => $em->getRepository(Article::class)->find($request->request->get('article'))
        ]);

        if ($form->isValid()) {
            $em->persist($favorite);
            $em->flush();

            return $favorite;
        }

        return $form;
    }
}
