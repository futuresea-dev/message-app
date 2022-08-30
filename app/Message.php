<?php

namespace App;
class Message
{
    protected User $sender;
    protected User $receiver;
    protected string $messageText;
    protected int $messageType;
    protected int $createdAt;

    public function __construct(
        User $sender,
        User $receiver,
        string $messageText,
        int $messageType
    )
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->messageText = $messageText;
        $this->messageType = $messageType;
        $this->createdAt = time();
    }

    public function getSenderFullName(): string
    {
        return $this->sender->getFullName();
    }

    public function getReceiverFullName(): string
    {
        return $this->receiver->getFullName();
    }

    public function getTextMessage(): string
    {
        return $this->messageText;
    }

    public function getCreatedAt(): string
    {
        return date('l jS \of F Y h:i:s A', $this->createdAt);
    }

    public function sendTextMessage(): bool
    {
        if (($this->sender->getRole() == Role::$TEACHER)
            && ($this->messageType == MessageType::$SYSTEM)
        ) {
            if ($this->receiver->getRole() != Role::$STUDENT) {
                echo "\r\nSend failed! System message not allowed for
                 this User type!";
                return false;
            }
        }

        if (($this->sender->getRole() == Role::$STUDENT
                || $this->sender->getRole() == Role::$PARENT)
            && ($this->receiver->getRole() == Role::$PARENT
                || $this->sender->getRole() == Role::$STUDENT)
        ) {
            echo(
            "\r\nSend failed to send text. These users are not allowed 
            to message each other."
            );
            return false;
        }

        echo "\r\nMessage sent successfully";
        return true;
    }

    public function save(): bool
    {
        if (($this->sender->getRole() != Role::$TEACHER)
            && ($this->messageType == MessageType::$SYSTEM)
        ) {
            echo "\r\nSave failed to save text due to forbidden access.";
            return false;
        }

        echo "\r\nSaved successfully.";
        return true;
    }

}

