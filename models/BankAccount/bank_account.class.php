<?php

/**
 * Author: Cameron Crosby
 * Date: 11/21/2024
 * File: bank_account.class.php
 * Description: Defines the BankAccount class. This stores one record from the bank_account table
 */
class BankAccount
{
    // Private attributes
    private ?int $id; //auto-generated
    private string $accountNickname, $accountType, $accountStatus, $userId;

    // constructor
    public function __construct($name, $type, $status, $userId) {
        $this->accountNickname = $name;
        $this->accountType = $type;
        $this->accountStatus = $status;
        $this->userId = $userId;
    }

    // Get the account's autogenerated id
    public function getId(): ?int
    {
        return $this->id;
    }

    // set account's autogenerated id
    public function setId(?int $id): BankAccount
    {
        $this->id = $id;
        return $this;
    }

    // get account's Nickname
    public function getAccountNickname(): string
    {
        return $this->accountNickname;
    }

    // set account's nickname
    public function setAccountNickname(string $accountNickname): BankAccount
    {
        $this->accountNickname = $accountNickname;
        return $this;
    }

    // get account type (checking or savings)
    public function getAccountType(): string
    {
        return $this->accountType;
    }

    // set account type (checking or savings)
    public function setAccountType(string $accountType): BankAccount
    {
        $this->accountType = $accountType;
        return $this;
    }

    // get account status (good standing or overdrawn)
    public function getAccountStatus(): string
    {
        return $this->accountStatus;
    }

    // set account status (good standing or overdrawn)
    public function setAccountStatus(string $accountStatus): BankAccount
    {
        $this->accountStatus = $accountStatus;
        return $this;
    }

    // Get account's associated user id
    public function getUserId(): string
    {
        return $this->userId;
    }

    // set user's associated account id
    public function setUserId(string $userId): BankAccount
    {
        $this->userId = $userId;
        return $this;
    }

}