<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Entity\Article;
use App\Entity\User;

/**
 * @IsGranted("ROLE_USER")
 */
class MeController extends AbstractController
{
    /**
     * Retrieves the authenticated User.
     *
     * @Rest\View(serializerGroups={"getMe"})
     * @Rest\Get("/me")
     *
     * @SWG\Tag(name="Me")
     * @SWG\Response(
     *     response=200,
     *     description="User response.",
     *     @SWG\Schema(
     *         ref=@Model(type=User::class, groups={"getMe"})
     *     )
     * )
     */
    public function getMe()
    {
        return $this->getUser();
    }

    /**
     * Retrieves the collection of favorite Article resources of the authenticated User.
     *
     * @Rest\View(serializerGroups={"getMyFavorites"})
     * @Rest\Get("/me/favorites")
     *
     * @SWG\Tag(name="Me")
     * @SWG\Response(
     *     response=200,
     *     description="Article collection response.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class, groups={"getMyFavorites"}))
     *     )
     * )
     */
    public function getMyFavorites()
    {
        $favorites = [];
        foreach ($this->getUser()->getFavorites() ?? [] as $favorite) {
            $favorites[] = $favorite->getArticle();
        }

        return $favorites;
    }
}
