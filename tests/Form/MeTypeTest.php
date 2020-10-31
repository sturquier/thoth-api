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
            'email' => 'foo@bar.com'
        ];

        $userToCompare = new User();
        $form = $this->factory->create(MeType::class, $userToCompare);

        $user = new User();
        $user->setEmail($formData['email']);

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
