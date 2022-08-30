<?php

use PHPUnit\Framework\TestCase;
use App\User;
use App\Role;

class UserTest extends TestCase
{
    private User $_student;
    private User $_parent;
    private User $_teacher;
    private User $_invalidUser;

    public function setUp(): void
    {
        $this->_student = new User(
            1, 
            "Mark", 
            "Jeans",
            "mark.jeans@gmail.com",
            Role::$STUDENT
        );

        $this->_parent = new User(
            2, 
            "Luke", 
            "Jeans",
            "luke.jeans@gmail.com",
            Role::$PARENT,
            "Mr"
        );

        $this->_teacher = new User(
            3, 
            "Mary", 
            "Thompson",
            "mary.thompson@gmail.com",
            Role::$TEACHER,
            "Miss"
        );

        $this->_invalidUser = new User(
            4, 
            "Jane", 
            "Doe",
            "jane.doegmail",
            Role::$STUDENT,
            "Miss",
            "jane.me"
        );
    }

    public function testUserFullName()
    {
        $this->assertEquals("Miss Mary Thompson", $this->_teacher->getFullName());
        $this->assertEquals("Mark Jeans", $this->_student->getFullName());
    }

    public function testUserEmail()
    {
        $this->assertEquals("mary.thompson@gmail.com", $this->_teacher->getEmail());
    }

    public function testUserId()
    {
        $this->assertEquals(2, $this->_parent->getUserId());
    }

    public function testUserSave()
    {
        $this->assertEquals(false, $this->_invalidUser->save());
        $this->assertEquals(true, $this->_teacher->save());
    }

}