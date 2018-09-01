<?php

namespace WWON\Entity\Tests;

use WWON\Entity\ShitCodeException;
use WWON\Entity\Tests\TestDoubles\Entity;

class EntityTest extends TestCase
{
    public function testSetData()
    {
        $entity = new Entity();

        $entity->setData([
            'id' => 1,
            'email' => 'test@example.com',
            'first_name' => 'Jason',
            'last_name' => 'String'
        ]);

        $this->assertEquals(1, $entity->id);
        $this->assertEquals('test@example.com', $entity->email);
        $this->assertEquals('Jason', $entity->firstName);
        $this->assertEquals('String', $entity->lastName);
    }

    public function testSetDataWithExtraProperty()
    {
        $entity = new Entity();

        $entity->setData([
            'id' => 1,
            'email' => 'test@example.com',
            'first_name' => 'Jason',
            'last_name' => 'String',
            'power_level' => 100
        ]);

        $this->assertEquals(1, $entity->id);
        $this->assertEquals('test@example.com', $entity->email);
        $this->assertEquals('Jason', $entity->firstName);
        $this->assertEquals('String', $entity->lastName);
        $this->assertNull($entity->powerLevel);
    }

    public function testToArray()
    {
        $entity = new Entity();

        $entity->setData([
            'id' => 1,
            'email' => 'test@example.com',
            'first_name' => 'Jason',
            'last_name' => 'String'
        ]);

        $this->assertEquals([
            'id' => 1,
            'email' => 'test@example.com',
            'first_name' => 'Jason',
            'last_name' => 'String'
        ], $entity->toArray());
    }

    public function testToArrayWithEmptyFields()
    {
        $entity = new Entity();

        $entity->setData([
            'id' => 1,
            'email' => 'test@example.com'
        ]);

        $this->assertEquals([
            'id' => 1,
            'email' => 'test@example.com',
            'first_name' => null,
            'last_name' => null
        ], $entity->toArray());
    }

    public function testToArrayIgnoreEmptyFields()
    {
        $entity = new Entity();

        $entity->setData([
            'id' => 1,
            'email' => 'test@example.com'
        ]);

        $this->assertEquals([
            'id' => 1,
            'email' => 'test@example.com'
        ], $entity->toArray(true));
    }

    public function testCannotSetNonFieldValue()
    {
        $entity = new Entity();

        $this->expectException(ShitCodeException::class);

        $entity->password = 'abc123';
    }
}
