<?php

namespace models;

enum account_type {
    case user;
    case admin;
}

class user
{
    private int $user_id;
    private string $email;
    private string $password;
    private account_type $account_type;

    public function __construct(int $user_id, string $email, string $password, account_type $account_type)
    {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->account_type = $account_type;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAccountType(): account_type
    {
        return $this->account_type;
    }

    public function setAccountType(account_type $account_type): void
    {
        $this->account_type = $account_type;
    }
}