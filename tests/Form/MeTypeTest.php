<?php

namespace App\Tests\Form;

use App\Form\MeType;
use App\Entity\User;
use Symfony\Component\Form\Test\TypeTestCase;

class MeTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'firstName' => 'Foo',
            'lastName' => 'Bar',
            'email' => 'foo@bar.com',
            'password' => 'fooBar1'
        ];

        $userToCompare = new User();
        $form = $this->factory->create(MeType::class, $userToCompare);

        $user = new User();
        $user->setFirstName($formData['firstName']);
        $user->setLastName($formData['lastName']);
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
