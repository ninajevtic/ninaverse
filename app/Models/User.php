<?php

namespace App\Models;

use Core\Validator;
use Exception;

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
     * @var int Unix timestamp when the user was created
     */
    private int $createdAt;
    /**
     * **Update timestamp**
     *
     * @var int Unix timestamp of the last update
     */
    private int $updatedAt;
    /**
     * **Soft delete timestamp**
     *
     * @var int|null Timestamp of deletion, or null if not deleted
     */
    private ?int $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * **Constructs a new User instance.**
     *
     * @param int         $userId         **Unique identifier for the user**
     * @param string      $name           **Full name of the user**
     * @param string      $email          **User's email address**
     * @param string      $passwordHash   **Hashed password of the user**
     * @param string|null $profilePicture **URL of the user's profile picture**
     * @param bool        $isVerified     **Indicates whether the user is verified**
     * @param int         $createdAt      **Unix timestamp when the user was created**
     * @param int         $updatedAt      **Unix timestamp of the last update**
     * @param int|null    $deletedAt      **Unix timestamp of deletion, or null if not deleted**
     */
    public function __construct(
        int $userId,
        string $name,
        string $email,
        string $passwordHash,
        ?string $profilePicture,
        bool $isVerified,
        int $createdAt,
        int $updatedAt,
        int $deletedAt = null
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
    // #region Validation Rules
    // Pravila validacije za User model
    public static array $rules = [
        'name' => [
            'string' => ['min' => 8, 'max' => 100],
        ],
    ];
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
     * @return int **Unix timestamp when the user was created**
     */
    public function getCreatedAt(): int
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
     * @return int|null **Timestamp of deletion, or null if not deleted**
     */
    public function getDeletedAt(): ?int
    {
        return $this->deletedAt;
    }
    // #endregion
    // #region Setters
    /**
     * **Sets the user ID.**
     *
     * Validates the user ID before setting it.
     *
     * @param int $userId **Unique identifier for the user**
     *
     * @return void
     * @throws Exception if the user ID is invalid
     *
     */
    public function setUserId(int $userId): void
    {
        if (!Validator::numberic($userId)) {
            throw new Exception('Invalid user ID.');
        }
        $this->userId = $userId;
    }

    /**
     * **Sets the user's name.**
     *
     * Validates the user name before setting it.
     *
     * @param string $name **Full name of the user**
     *
     * @return void
     * @throws Exception if the user name is invalid
     *
     */
    public function setName(string $name): void
    {
//        if (!Validator::string($name, 8, 100)) {
//            throw new Exception('Invalid user name.');
//        }
        if (!Validator::validate($name, self::$rules['name'])) {
            throw new Exception('Invalid user name.');
        }
        $this->name = $name;
    }

    /**
     * **Sets the user's email address.**
     *
     * Validate the user mail before setting it.
     *
     * @param string $email **User's email address**
     *
     * @throws Exception if the user email is invalid
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        if (!Validator::email($email)) {
            throw new Exception('Invalid user email.');
        }
        $this->email = $email;
    }

    /**
     * **Sets the hashed password.**
     *
     * Validates the hashed password before setting it.
     *
     * @param string $passwordHash **Hashed password of the user**
     *
     * @return void
     * @throws Exception if the hashed password is invalid
     *
     */
    public function setPasswordHash(string $passwordHash): void
    {
        if (!Validator::passwordHash($passwordHash)) {
            throw new Exception('Invalid password hash.');
        }
        $this->passwordHash = $passwordHash;
    }

    /**
     * **Sets the profile picture URL.**
     *
     * Validates the profile picture URL before setting it.
     *
     * @param string|null $profilePicture **URL of the user's profile picture**
     *
     * @throws Exception if the profile picture URL is invalid
     *
     * @return void
     */
    public function setProfilePicture(?string $profilePicture): void
    {
        if ($profilePicture !== null
            && !Validator::profilePicture(
                $profilePicture
            )
        ) {
            throw new Exception('Invalid profile picture URL.');
        }
        $this->profilePicture = $profilePicture;
    }

    /**
     * **Sets the verification status.**
     *
     * Validates the verification status before setting it.
     *
     * @param bool $isVerified **Indicates whether the user is verified**
     *
     * @throws Exception if the verification status is invalid
     *
     * @return void
     */
    public function setIsVerified(bool $isVerified): void
    {
        if (!Validator::boolean($isVerified)) {
            throw new Exception('Invalid value for isVerified. Must be a boolean.');
        }
        $this->isVerified = $isVerified;
    }

//    /**
//     * **Sets the creation timestamp.**
//     *
//     * Validates the created timestamp before setting it.
//     *
//     * @param DateTime $createdAt **Date and time of user creation**
//     *
//     * @return void
//     */
//    public function setCreatedAt(DateTime $createdAt): void
//    {
//        $this->createdAt = $createdAt;
//    }
//    /**
//     * **Sets the last updated timestamp.**
//     *
//     *
//     * @param int $updatedAt **Unix timestamp of the last update**
//     *
//     * @return void
//     */
//    public function setUpdatedAt(int $updatedAt): void
//    {
//        $this->updatedAt = $updatedAt;
//    }
    /**
     * **Sets the soft delete timestamp.**
     * If the user is deleted, set this to the deletion timestamp; otherwise, it is `null`.
     *
     * Validates the deleted timestamp before setting it.
     *
     * @param int $deletedAt **Unix timestamp of deletion**
     *
     * @throw Exception if the delete timestamp is invalid
     *
     * @return void
     */
    public function setDeletedAt(int $deletedAt): void
    {
        if (!Validator::timestamp($deletedAt)) {
            throw new Exception('Invalid Unix timestamp deletion.');
        }
        $this->deletedAt = $deletedAt;
    }
    // #endregion
}