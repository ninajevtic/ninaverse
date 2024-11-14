<?php

namespace App\Models;

use DateTime;
use Enums\ChatType;

class Chat
{
    // #region Properties
    /**
     *  **Chat ID**
     * @var int ID of the chat
     */
    private int $chatId;
    /**
     * **Name of the chat**
     * @var string|null Name or title of the chat
     */
    private ?string $name;
    /**
     * **Type of chat**
     * @var ChatType Indicates whether the chat is public or private
     */
    private ChatType $chatType;
    /**
     * **ID of the user who created the chat**
     * @var int User ID of the chat creator
     */
    private int $createdBy;
    /**
     * **Date and time of chat creation**
     * @var DateTime When the chat was created
     */
    private DateTime $createdAt;
    /**
     * **Timestamp of the last update**
     * @var int Unix timestamp of the last update
     */
    private int $updatedAt;
    /**
     * **Soft delete date and time**
     * @var DateTime|null If the chat is deleted, contains the deletion date and time; otherwise, null
     */
    private ?DateTime $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * **Constructs a new Chat instance.**
     *
     * @param int           $chatId      **Chat ID**
     * @param string|null   $name        **Name or title of the chat**
     * @param ChatType      $chatType    **Type of chat** (public or private)
     * @param int           $createdBy   **User ID of the chat creator**
     * @param DateTime      $createdAt   **Date and time of chat creation**
     * @param int           $updatedAt   **Timestamp of the last update**
     * @param DateTime|null $deletedAt   **Date and time of chat deletion** (null if not deleted)
     */
    public function __construct(
        int $chatId,
        ?string $name,
        ChatType $chatType,
        int $createdBy,
        DateTime $createdAt,
        int $updatedAt,
        ?DateTime $deletedAt = null
    ) {
        $this->chatId = $chatId;
        $this->name = $name;
        $this->chatType = $chatType;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    // #endregion
    // #region Getters
    /**
     * **Returns the chat ID.**
     *
     * @return int **Chat ID**
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * **Returns the name of the chat.**
     *
     * @return string|null **Name or title of the chat**
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * **Returns the type of the chat.**
     *
     * @return ChatType **Type of the chat** (public or private)
     */
    public function getChatType(): ChatType
    {
        return $this->chatType;
    }

    /**
     * **Returns the creator's user ID.**
     *
     * @return int **User ID of the chat creator**
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * **Returns the date and time of creation.**
     *
     * @return DateTime **Date and time when the chat was created**
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
     * **Returns the date and time of deletion.**
     * Returns `null` if the chat has not been deleted.
     *
     * @return DateTime|null **Date and time when the chat was deleted, or null if not deleted**
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    // #endregion
    // #region Setters
    /**
     * **Sets the chat ID.**
     *
     * @param int $chatId **ID of the chat**
     *
     * @return void
     */
    public function setChatId(int $chatId): void
    {
        $this->chatId = $chatId;
    }

    /**
     * **Sets the name of the chat.**
     *
     * @param string|null $name **Name or title of the chat**
     *
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * **Sets the chat type.**
     *
     * @param ChatType $chatType **Type of the chat** (public or private)
     *
     * @return void
     */
    public function setChatType(ChatType $chatType): void
    {
        $this->chatType = $chatType;
    }

    /**
     * **Sets the creator's user ID.**
     *
     * @param int $createdBy **User ID of the chat creator**
     *
     * @return void
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * **Sets the creation date and time.**
     *
     * @param DateTime $createdAt **Date and time of creation**
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
     * **Sets the deletion date and time.**
     * If the chat is deleted, set this to the deletion date; otherwise, set to `null`.
     *
     * @param DateTime|null $deletedAt **Date and time when the chat was deleted, or null if not deleted**
     *
     * @return void
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
    // #endregion
}
