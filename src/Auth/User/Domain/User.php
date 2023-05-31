<?php

declare(strict_types=1);

namespace Src\Auth\User\Domain;


use Src\Auth\User\Domain\ValueObjects\UserActived;
use Src\Auth\User\Domain\ValueObjects\UserDeleted;
use Src\Auth\User\Domain\ValueObjects\UserEmail;
use Src\Auth\User\Domain\ValueObjects\UserFirstName;
use Src\Auth\User\Domain\ValueObjects\UserId;
use Src\Auth\User\Domain\ValueObjects\UserIdClient;
use Src\Auth\User\Domain\ValueObjects\UserLevel;
use Src\Auth\User\Domain\ValueObjects\UserIdRole;
use Src\Auth\User\Domain\ValueObjects\UserLastName;
use Src\Auth\User\Domain\ValueObjects\UserPhone;
use Src\Auth\User\Domain\ValueObjects\UserUserName;

final class User
{
    /**
     * @var UserId
     */
    private $id;
    /**
     * @var UserUserName
     */
    private $username;
    /**
     * @var UserFirstName
     */
    private $firstName;
    /**
     * @var UserLastName
     */
    private $lastName;
    /**
     * @var UserEmail
     */
    private $email;
    /**
     * @var UserPhone
     */
    private $phone;
    /**
     * @var UserLevel
     */
    private $level;
    /**
     * @var UserActived
     */
    private $actived;
    /**
     * @var UserDeleted
     */
    private $deleted;
    /**
     * @var UserIdClient
     */
    private $idClient;
    /**
     * @var UserIdRole
     */
    private $idRole;

    /**
     * User constructor.
     * @param UserId $id
     * @param UserUserName $username
     * @param UserFirstName $firstName
     * @param UserLastName $lastName
     * @param UserEmail $email
     * @param UserPhone $phone
     * @param UserLevel $level
     * @param UserActived $actived
     * @param UserDeleted $deleted
     * @param UserIdClient $idClient
     * @param UserIdRole $idRole
     */
    public function __construct(
        UserId $id,
        UserUserName $username,
        UserFirstName $firstName,
        UserLastName $lastName,
        UserEmail $email,
        UserPhone $phone,
        UserLevel $level,
        UserActived $actived,
        UserDeleted $deleted,
        UserIdClient $idClient,
        UserIdRole $idRole
    )
    {
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->level = $level;
        $this->actived = $actived;
        $this->deleted = $deleted;
        $this->idClient = $idClient;
        $this->idRole = $idRole;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserUserName
     */
    public function getUsername(): UserUserName
    {
        return $this->username;
    }

    /**
     * @return UserFirstName
     */
    public function getFirstName(): UserFirstName
    {
        return $this->firstName;
    }

    /**
     * @return UserLastName
     */
    public function getLastName(): UserLastName
    {
        return $this->lastName;
    }

    /**
     * @return UserEmail
     */
    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPhone
     */
    public function getPhone(): UserPhone
    {
        return $this->phone;
    }

    /**
     * @return UserLevel
     */
    public function getLevel(): UserLevel
    {
        return $this->level;
    }

    /**
     * @return UserActived
     */
    public function getActived(): UserActived
    {
        return $this->actived;
    }

    /**
     * @return UserDeleted
     */
    public function getDeleted(): UserDeleted
    {
        return $this->deleted;
    }

    /**
     * @return UserIdClient
     */
    public function getIdClient(): UserIdClient
    {
        return $this->idClient;
    }

    /**
     * @return UserIdRole
     */
    public function getIdRole(): UserIdRole
    {
        return $this->idRole;
    }

}
