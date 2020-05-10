<?php

namespace App\Security;

use App\Entity\AuthenticationToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports(Request $request)
    {
        return $request->headers->has('Authorization') && 0 === strpos($request->headers->get('Authorization'), 'Bearer ');
    }

    public function getCredentials(Request $request)
    {
        return substr($request->headers->get('Authorization'), 7);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $this->em->getRepository(AuthenticationToken::class)->findOneBy(['token' => $credentials]);

        if (!$token) {
            throw new CustomUserMessageAuthenticationException('Invalid API Token');
        }

        return $token->getUser();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'message' => 'API Token not found'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
