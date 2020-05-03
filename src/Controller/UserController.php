<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use App\Form\UserType;
use App\Entity\User;

/**
 * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
 */
class UserController extends AbstractController
{
    /**
     * Creates a User resource.
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"createUser"})
     * @Rest\Post("/users")
     *
     * @SWG\Tag(name="User")
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     description="The new User resource.",
     *     @Model(type=UserType::class)
     * )
     * @SWG\Response(
     *     response=201,
     *     description="User resource created.",
     *     @SWG\Schema(
     *         ref=@Model(type=User::class, groups={"createUser"})
     *     )
     * )
     */
    public function createUser(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $user;
        }

        return $form;
    }
}
