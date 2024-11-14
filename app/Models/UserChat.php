<?php

namespace Models;

use DateTime;

class UserChat
{
    // #region Properties
    /**
     * **UserChat ID**
     * @var int Unique identifier for the UserChat record
     */
    private int $id;

    /**
     * **Chat ID**
     * @var int Identifier of the associated chat
     */
    private int $chatId;

    /**
     * **User ID**
     * @var int Identifier of the associated user
     */
    private int $userId;

    /**
     * **Joined timestamp**
     * @var int Unix timestamp when the user joined the chat
     */
    private int $joinedAt;

    /**
     * **Soft delete timestamp**
     * @var DateTime|null Timestamp of deletion, or null if not deleted
     */
    private ?DateTime $deletedAt;
    // #endregion

    // #region Constructor
    /**
     * **Constructs a new UserChat instance.**
     *
     * @param int           $id        **Unique identifier for the UserChat record**
     * @param int           $chatId    **Identifier of the associated chat**
     * @param int           $userId    **Identifier of the associated user**
     * @param int           $joinedAt  **Unix timestamp when the user joined the chat**
     * @param DateTime|null $deletedAt **Timestamp of deletion, or null if not deleted**
     */
    public function __construct(
        int $id,
        int $chatId,
        int $userId,
        int $joinedAt,
        ?DateTime $deletedAt = null
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
     * @param int $id **Unique identifier for the UserChat record**
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * **Sets the associated chat ID.**
     *
     * @param int $chatId **Identifier of the associated chat**
     *
     * @return void
     */
    public function setChatId(int $chatId): void
    {
        $this->chatId = $chatId;
    }

    /**
     * **Sets the associated user ID.**
     *
     * @param int $userId **Identifier of the associated user**
     *
     * @return void
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * **Sets the joined timestamp.**
     *
     * @param int $joinedAt **Unix timestamp when the user joined the chat**
     *
     * @return void
     */
    public function setJoinedAt(int $joinedAt): void
    {
        $this->joinedAt = $joinedAt;
    }

    /**
     * **Sets the soft delete timestamp.**
     * If the record is deleted, set this to the deletion timestamp; otherwise, set to `null`.
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
