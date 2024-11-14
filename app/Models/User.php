<?php

namespace App\Models;

use DateTime;

class User
{
    // #region Properties
    /**
     * **User ID**
     *
     * @var int Unique identifier for the user
     */
    private int $userId;
    /**
     * **Name of the user**
     *
     * @var string Full name of the user
     */
    private string $name;
    /**
     * **Email address of the user**
     *
     * @var string User's email address
     */
    private string $email;
    /**
     * **Hashed password**
     *
     * @var string Hashed password of the user
     */
    private string $passwordHash;
    /**
     * **Profile picture URL**
     *
     * @var string|null URL of the user's profile picture
     */
    private ?string $profilePicture;
    /**
     * **User verification status**
     *
     * @var bool Indicates whether the user is verified
     */
    private bool $isVerified;
    /**
     * **Creation timestamp**
     *
     * @var DateTime Date and time when the user was created
     */
    private DateTime $createdAt;
    /**
     * **Update timestamp**
     *
     * @var int Unix timestamp of the last update
     */
    private int $updatedAt;
    /**
     * **Soft delete timestamp**
     *
     * @var DateTime|null Timestamp of deletion, or null if not deleted
     */
    private ?DateTime $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * **Constructs a new User instance.**
     *
     * @param int           $userId         **Unique identifier for the user**
     * @param string        $name           **Full name of the user**
     * @param string        $email          **User's email address**
     * @param string        $passwordHash   **Hashed password of the user**
     * @param string|null   $profilePicture **URL of the user's profile picture**
     * @param bool          $isVerified     **Indicates whether the user is verified**
     * @param DateTime      $createdAt      **Date and time when the user was created**
     * @param int           $updatedAt      **Unix timestamp of the last update**
     * @param DateTime|null $deletedAt      **Timestamp of deletion, or null if not deleted**
     */
    public function __construct(
        int $userId,
        string $name,
        string $email,
        string $passwordHash,
        ?string $profilePicture,
        bool $isVerified,
        DateTime $createdAt,
        int $updatedAt,
        ?DateTime $deletedAt = null
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
    /**
     * **Returns the user ID.**
     *
     * @return int **Unique identifier for the user**
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * **Returns the user's name.**
     *
     * @return string **Full name of the user**
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * **Returns the user's email address.**
     *
     * @return string **User's email address**
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * **Returns the hashed password.**
     *
     * @return string **Hashed password of the user**
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * **Returns the profile picture URL.**
     *
     * @return string|null **URL of the user's profile picture**
     */
    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    /**
     * **Returns the user's verification status.**
     *
     * @return bool **Indicates whether the user is verified**
     */
    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * **Returns the creation timestamp.**
     *
     * @return DateTime **Date and time when the user was created**
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * **Returns the last updated timestamp.**
     *
     * @return int **Unix timestamp of the last update**
     */
    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

    /**
     * **Returns the soft delete timestamp.**
     * Returns `null` if the user is not deleted.
     *
     * @return DateTime|null **Timestamp of deletion, or null if not deleted**
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
    // #endregion
    // #region Setters
    /**
     * **Sets the user ID.**
     *
     * @param int $userId **Unique identifier for the user**
     *
     * @return void
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * **Sets the user's name.**
     *
     * @param string $name **Full name of the user**
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * **Sets the user's email address.**
     *
     * @param string $email **User's email address**
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * **Sets the hashed password.**
     *
     * @param string $passwordHash **Hashed password of the user**
     *
     * @return void
     */
    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * **Sets the profile picture URL.**
     *
     * @param string|null $profilePicture **URL of the user's profile picture**
     *
     * @return void
     */
    public function setProfilePicture(?string $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

    /**
     * **Sets the verification status.**
     *
     * @param bool $isVerified **Indicates whether the user is verified**
     *
     * @return void
     */
    public function setIsVerified(bool $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    /**
     * **Sets the creation timestamp.**
     *
     * @param DateTime $createdAt **Date and time of user creation**
     *
     * @return void
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * **Sets the last updated timestamp.**
     *
     * @param int $updatedAt **Unix timestamp of the last update**
     *
     * @return void
     */
    public function setUpdatedAt(int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * **Sets the soft delete timestamp.**
     * If the user is deleted, set this to the deletion timestamp; otherwise, set to `null`.
     *
     * @param DateTime|null $deletedAt **Timestamp of deletion, or null if not deleted**
     *
     * @return void
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
    // #endregion
}