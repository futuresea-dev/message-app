<?php

use App\Message;
use App\MessageType;
use PHPUnit\Framework\TestCase;
use App\User;
use App\Role;

class MessageTest extends TestCase
{
    private Message $_teachStudMsg;
    private Message $_teachParentMsg;
    private Message $_studTeachMsg;
    private Message $_parentTeachMsg;
    private Message $_invalidTextMessage;

    public function setUp(): void
    {
        $_student = new User(
            1, 
            "Mark", 
            "Jeans",
            "mark.jeans@gmail.com",
            Role::$STUDENT
        );

        $_parent = new User(
            2, 
            "Luke", 
            "Jeans",
            "luke.jeans@gmail.com",
            Role::$PARENT,
            "Mr"
        );

        $_teacher = new User(
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

        $this->_teachStudMsg = new Message(
            $_teacher,
            $_student,
            "Congratulations! You won the award!",
            MessageType::$SYSTEM
        );

        $this->_teachParentMsg = new Message(
            $_teacher,
            $_parent,
            "Congratulations! Your ward won an award!",
            MessageType::$MANUAL
        );

        $this->_studTeachMsg = new Message(
            $_student,
            $_teacher,
            "Thank you! Will do better!",
            MessageType::$MANUAL
        );

        $this->_parentTeachMsg = new Message(
            $_parent,
            $_teacher,
            "Will be at the PTA meeting!",
            MessageType::$MANUAL
        );

        $this->_invalidTextMessage = new Message(
            $_student,
            $_teacher,
            "I will be late for class today!",
            MessageType::$SYSTEM
        );
    }

    public function testSystemMessagesFromTeachersToStudentsOnly()
    {
        $this->assertTrue($this->_teachStudMsg->sendTextMessage());
    }

    public function testSystemMessagesFromTeachersToParentsOnly()
    {
        $this->assertFalse($this->_teachParentMsg->sendTextMessage());
    }

    public function testSenderAndReceiverFullName()
    {
        $this->assertEquals(
            "Miss Mary Thompson", 
            $this->_teachStudMsg->getSenderFullName()
        );

        $this->assertEquals(
            "Mark Jeans", 
            $this->_teachStudMsg->getReceiverFullName()
        );
    }

    public function testGetMessageText()
    {
        $this->assertEquals(
            "Thank you! Will do better!", 
            $this->_studTeachMsg->getTextMessage()
        );
    }

    public function testGetTimeOfMessageInHumanReadableFormat()
    {
        $this->assertEquals(
            date('l jS \of F Y h:i:s A', time()), 
            $this->_parentTeachMsg->getCreatedAt()
        );
    }

    public function testMessageSave()
    {
        $this->assertEquals(false, $this->_invalidTextMessage->save());
        $this->assertEquals(true, $this->_teachStudMsg->save());
    }

}