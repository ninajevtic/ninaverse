<?php

namespace Models;

use DateTime;

class UserChat
{
    // #region Properties
    /**
     * **UserChat ID**
     *
     * @var int Unique identifier for the UserChat record
     */
    private int $id;
    /**
     * **Chat ID**
     *
     * @var int Identifier of the associated chat
     */
    private int $chatId;
    /**
     * **User ID**
     *
     * @var int Identifier of the associated user
     */
    private int $userId;
    /**
     * **Joined timestamp**
     *
     * @var int Unix timestamp when the user joined the chat
     */
    private int $joinedAt;
    /**
     * **Soft delete timestamp**
     *
     * @var int|null Timestamp of deletion, or null if not deleted
     */
    private ?int $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * **Constructs a new UserChat instance.**
     *
     * @param int      $id        **Unique identifier for the UserChat record**
     * @param int      $chatId    **Identifier of the associated chat**
     * @param int      $userId    **Identifier of the associated user**
     * @param int      $joinedAt  **Unix timestamp when the user joined the chat**
     * @param int|null $deletedAt **Timestamp of deletion, or null if not deleted**
     */
    public function __construct(
        int $id,
        int $chatId,
        int $userId,
        int $joinedAt,
        ?int $deletedAt = null
    ) {
        $this->id = $id;
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->joinedAt = $joinedAt;
        $this->deletedAt = $deletedAt;
    }
    // #endregion
    // #region Getters
    /**
     * **Returns the UserChat ID.**
     *
     * @return int **Unique identifier for the UserChat record**
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * **Returns the associated chat ID.**
     *
     * @return int **Identifier of the associated chat**
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * **Returns the associated user ID.**
     *
     * @return int **Identifier of the associated user**
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * **Returns the joined timestamp.**
     *
     * @return int **Unix timestamp when the user joined the chat**
     */
    public function getJoinedAt(): int
    {
        return $this->joinedAt;
    }

    /**
     * **Returns the soft delete timestamp.**
     * Returns `null` if the record is not deleted.
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
     * **Sets the UserChat ID.**
     *
     * Validates the userChat ID before setting it.
     *
     * @param int $id **Unique identifier for the UserChat record**
     *
     * @throw Exception if the userChat ID is invalid
     *
     * @return void
     */
    public function setId(int $id): void
    {
        if (!Validator::numberic($id)) {
            throw new Exception('Invalid userChat ID.');
        }
        $this->id = $id;
    }

    /**
     * **Sets the associated chat ID.**
     *
     * Validates the chat ID before setting it.
     *
     * @param int $chatId **Identifier of the associated chat**
     *
     * @throw Exception if the chat ID is invalid
     *
     * @return void
     */
    public function setChatId(int $chatId): void
    {
        if (!Validator::numberic($chatId)) {
            throw new Exception('Invalid chat ID.');
        }
        $this->chatId = $chatId;
    }

    /**
     * **Sets the associated user ID.**
     *
     *  Validates the user ID before setting it.
     *
     * @param int $userId **Identifier of the associated user**
     *
     * @throw Exception if the user ID is invalid
     *
     * @return void
     */
    public function setUserId(int $userId): void
    {
        if (!Validator::numberic($userId)) {
            throw new Exception('Invalid user ID.');
        }
        $this->userId = $userId;
    }

    /**
     * **Sets the joined timestamp.**
     *
     * Validates the timestamp before setting it.
     *
     * @param int $joinedAt **Unix timestamp when the user joined the chat**
     *
     * @throw Exception if the joined timestamp is invalid
     *
     * @return void
     */
    public function setJoinedAt(int $joinedAt): void
    {
        if (!Validator::timestamp($joinedAt)) {
            throw new Exception('Invalid Unix timestamp joined.');
        }
        $this->joinedAt = $joinedAt;
    }

    /**
     * **Sets the soft delete timestamp.**
     * If the record is deleted, set this to the deletion timestamp; otherwise, set to `null`.
     *
     * Validates the timestamp before setting it.
     *
     * @param DateTime|null $deletedAt **Timestamp of deletion, or null if not deleted**
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
