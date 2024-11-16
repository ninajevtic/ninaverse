<?php

namespace App\Models;

use Core\Validator;
use Enums\ChatType;
use Exception;

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
     * **Unix timestamp of chat creation**
     * @var int When the chat was created
     */
    private int $createdAt;
    /**
     * **Timestamp of the last update**
     * @var int Unix timestamp of the last update
     */
    private int $updatedAt;
    /**
     * **Soft delete date and time**
     * @var int|null If the chat is deleted, contains the deletion timestamp; otherwise, null
     */
    private ?int $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * **Constructs a new Chat instance.**
     *
     * @param int           $chatId      **Chat ID**
     * @param string|null   $name        **Name or title of the chat**
     * @param ChatType      $chatType    **Type of chat** (public or private)
     * @param int           $createdBy   **User ID of the chat creator**
     * @param int           $createdAt   **Timestamp of chat creation**
     * @param int           $updatedAt   **Timestamp of the last update**
     * @param int|null      $deletedAt   **Timestamp of chat deletion** (null if not deleted)
     */
    public function __construct(
        int $chatId,
        ?string $name,
        ChatType $chatType,
        int $createdBy,
        int $createdAt,
        int $updatedAt,
        ?int $deletedAt = null
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
     * **Returns the timestamp of creation.**
     *
     * @return int **Unix timestamp when the chat was created**
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
     * **Returns the timestamp of deletion.**
     * Returns `null` if the chat has not been deleted.
     *
     * @return int|null **Date and time when the chat was deleted, or null if not deleted**
     */
    public function getDeletedAt(): ?int
    {
        return $this->deletedAt;
    }

    // #endregion
    // #region Setters
    /**
     * **Sets the chat ID.**
     *
     * Validates the chat ID before setting it.
     *
     * @param int $chatId **ID of the chat**
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
     * **Sets the name of the chat.**
     *
     * Validates the chat title before setting it.
     *
     * @param string|null $name **Name or title of the chat**
     *
     * @throw Exception if the title of the chat is invalid
     *
     * @return void
     */
    public function setName(?string $name): void
    {
        if ($name !== null && !Validator::string($name, 8, 100)) {
            throw new Exception('Invalid chat title.');
        }
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
     *  Validates the user ID before setting it.
     *
     * @param int $createdBy **User ID of the chat creator**
     *
     * @throw Exception if the user ID is invalid
     *
     * @return void
     */
    public function setCreatedBy(int $createdBy): void
    {
        if (!Validator::numberic($createdBy)) {
            throw new Exception('Invalid user ID.');
        }
        $this->createdBy = $createdBy;
    }

//    /**
//     * **Sets the creation timestamp.**
//     *
//     * @param int $createdAt **Unix timestamp of creation**
//     *
//     * @return void
//     */
//    public function setCreatedAt(int $createdAt): void
//    {
//        $this->createdAt = $createdAt;
//    }

//    /**
//     * **Sets the last updated timestamp.**
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
     * **Sets the deletion date and time.**
     * If the chat is deleted, set this to the deletion date; otherwise, it is `null`.
     *
     * Validates the timestamp before setting it.
     *
     * @param int|null $deletedAt **Unix timestamp when the chat was deleted, or null if not deleted**
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
