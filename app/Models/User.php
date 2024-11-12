<?php

namespace Models;

class User
{
    // #region Properties
    /** @var int User ID */
    private $userId;
    /** @var string Name of the user */
    private $name;
    /** @var string Email address of the user */
    private $email;
    /** @var string Hashed password */
    private $passwordHash;
    /** @var string|null Profile picture URL */
    private $profilePicture;
    /** @var bool Whether the user is verified */
    private $isVerified;
    /** @var string Creation timestamp */
    private $createdAt;
    /** @var string Update timestamp */
    private $updatedAt;
    /** @var string|null Soft delete timestamp */
    private $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * Constructor to initialize all properties of the User class.
     *
     * @param int         $userId
     * @param string      $name
     * @param string      $email
     * @param string      $passwordHash
     * @param string|null $profilePicture
     * @param bool        $isVerified
     * @param string      $createdAt
     * @param string      $updatedAt
     * @param string|null $deletedAt
     */
    public function __construct(
        $userId,
        $name,
        $email,
        $passwordHash,
        $profilePicture,
        $isVerified,
        $createdAt,
        $updatedAt,
        $deletedAt
    ) {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->profilePicture = $profilePicture;
        $this->isVerified = $isVerified;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    // #endregion
    // #region Getters
    public function getUserId()
    {
        return $this->userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    public function isVerified()
    {
        return $this->isVerified;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    // #endregion
    // #region Setters
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPasswordHash($passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
    }

    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
    // #endregion
}
