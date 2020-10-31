<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Form\MeType;
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
     * Updates the authenticated User.
     *
     * @Rest\View(serializerGroups={"patchMe"})
     * @Rest\Patch("/me")
     *
     * @SWG\Tag(name="Me")
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     description="The updated User resource.",
     *     @Model(type=MeType::class)
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Updated User response.",
     *     @SWG\Schema(
     *         ref=@Model(type=User::class, groups={"patchMe"})
     *     )
     * )
     */
    public function patchMe(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->getUser();

        $form = $this->createForm(MeType::class, $currentUser);
        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em->persist($currentUser);
            $em->flush();

            return $currentUser;
        }

        return $form;
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
