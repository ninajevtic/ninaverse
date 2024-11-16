<?php

namespace App\Models;

use Core\Validator;
use Exception;

class Message
{
    // #region Properties
    /**
     * **Message ID**
     *
     * @var int Unique identifier for the message
     */
    private int $messageId;
    /**
     * **Associated Chat ID**
     *
     * @var int ID of the chat to which this message belongs
     */
    private int $chatId;
    /**
     * **User who sent the message**
     *
     * @var User User instance representing the sender
     */
    private User $user;
    /**
     * **Message content**
     *
     * @var string Text content of the message
     */
    private string $content;
    /**
     * **Sent timestamp**
     *
     * @var int Unix timestamp indicating when the message was sent
     */
    private int $sentAt;
    /**
     * **Soft delete timestamp**
     *
     * @var int|null Null if not deleted, otherwise deletion timestamp
     */
    private ?int $deletedAt;
    // #endregion
    // #region Constructor
    /**
     * **Constructs a new Message instance.**
     *
     * @param int           $messageId **Unique ID of the message**
     * @param int           $chatId    **ID of the chat this message belongs to**
     * @param User          $user      **User instance of the message sender**
     * @param string        $content   **Content of the message**
     * @param int           $sentAt    **Timestamp of when the message was sent**
     * @param int|null $deletedAt **Timestamp of deletion if soft-deleted; null if active**
     */
    public function __construct(
        int $messageId,
        int $chatId,
        User $user,
        string $content,
        int $sentAt,
        ?int $deletedAt = null
    ) {
        $this->messageId = $messageId;
        $this->chatId = $chatId;
        $this->user = $user;
        $this->content = $content;
        $this->sentAt = $sentAt;
        $this->deletedAt = $deletedAt;
    }
    // #endregion
    // #region Getters
    /**
     * **Returns the message ID.**
     *
     * @return int **Unique identifier for the message**
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * **Returns the associated chat ID.**
     *
     * @return int **ID of the chat to which this message belongs**
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * **Returns the user who sent the message.**
     *
     * @return User **User instance representing the sender**
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * **Returns the content of the message.**
     *
     * @return string **Text content of the message**
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * **Returns the sent timestamp.**
     *
     * @return int **Unix timestamp of when the message was sent**
     */
    public function getSentAt(): int
    {
        return $this->sentAt;
    }

    /**
     * **Returns the soft delete timestamp.**
     * Returns `null` if the message is not deleted.
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
     * **Sets the message ID.**
     *
     * Validates the message ID before setting it.
     *
     * @param int $messageId **Unique identifier for the message**
     *
     * @throw Exception if the message ID is invalid
     *
     * @return void
     */
    public function setMessageId(int $messageId): void
    {
        if (!Validator::numberic($messageId)) {
            throw new Exception('Invalid chat ID.');
        }
        $this->messageId = $messageId;
    }

    /**
     * **Sets the associated chat ID.**
     *
     * Validates the chat ID before setting it.
     *
     * @param int $chatId **ID of the chat to which this message belongs**
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
     * **Sets the user who sent the message.**
     *
     * Validates the user before setting it.
     *
     * @param User $user **User instance representing the sender**
     *
     * @throw Exception if the User is invalid
     *
     * @return void
     */
    public function setUser(User $user): void
    {
        if (!$user instanceof User) {
            throw new Exception('Invalid user object provided.');
        }
        $this->user = $user;
    }

    /**
     * **Sets the content of the message.**
     *
     * Validates the content before setting it.
     *
     * @param string $content **Text content of the message**
     *
     * @throw Exception if the content of the message is invalid
     *
     * @return void
     */
    public function setContent(string $content): void
    {
        if (!Validator::string($content, 8, 1000)) {
            throw new Exception('Invalid message content.');
        }
        $this->content = $content;
    }

    /**
     * **Sets the sent timestamp.**
     *
     * Validates the timestamp before setting it.
     *
     * @param int $sentAt **Unix timestamp of when the message was sent**
     *
     * @throw Exception if the sent timestamp is invalid
     *
     * @return void
     */
    public function setSentAt(int $sentAt): void
    {
        if (!Validator::timestamp($sentAt)) {
            throw new Exception('Invalid Unix timestamp sent.');
        }
        $this->sentAt = $sentAt;
    }

    /**
     * **Sets the soft delete timestamp.**
     * If the message is deleted, set this to the deletion timestamp; otherwise, set to `null`.
     *
     * Validates the timestamp before setting it.
     *
     * @param int|null $deletedAt **Timestamp of deletion, or null if not deleted**
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