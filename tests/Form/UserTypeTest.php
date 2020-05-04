<?php

namespace App\Tests\Form;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\Form\Test\TypeTestCase;

class UserTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'email' => 'foo@bar.com',
            'password' => 'fooBar1'
        ];

        $userToCompare = new User();
        $form = $this->factory->create(UserType::class, $userToCompare);

        $user = new User();
        $user->setEmail($formData['email']);
        $user->setPassword($formData['password']);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($user, $userToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
