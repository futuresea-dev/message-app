<?php

namespace App;
class User
{
    protected string $userId;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected int $role;
    protected string $salutation;
    protected string $profilePhoto;

    public function __construct(
        int $userId,
        string $firstName,
        string $lastName,
        string $email,
        int $role,
        string $salutation = "",
        string $profilePhoto = "avatar.jpg"
    )
    {
        $this->userId = $userId;
        $this->salutation = $salutation;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
        $this->profilePhoto = $profilePhoto;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getFullName(): string
    {
        if ($this->role == Role::$STUDENT) {
            return ucwords(
                $this->firstName . " " . $this->lastName
            );
        }
        return ucwords(
            $this->salutation . " " . $this->firstName . " " . $this->lastName
        );
    }

    public function save(): bool
    {
        // Remove all illegal characters from email
        $email = filter_var($this->getEmail(), FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            echo "\r\nFailed to save user with invalid email: $email";
            return false;
        }

        // Validate photo
        $photoExtension = pathinfo($this->getProfilePhoto(), PATHINFO_EXTENSION);
        if ($photoExtension != "jpg") {
            echo(
            "\r\nFailed to save with invalid profile photo"
            );
            return false;
        }

        echo "\r\nUser saved successfully.";
        return true;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getProfilePhoto(): string
    {
        return $this->profilePhoto;
    }
}

?>