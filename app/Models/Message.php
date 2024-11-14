<?php

namespace App\Models;

use DateTime;

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
     * @var DateTime|null Null if not deleted, otherwise deletion timestamp
     */
    private ?DateTime $deletedAt;
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
     * @param DateTime|null $deletedAt **Timestamp of deletion if soft-deleted; null if active**
     */
    public function __construct(
        int $messageId,
        int $chatId,
        User $user,
        string $content,
        int $sentAt,
        ?DateTime $deletedAt = null
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
     * @return DateTime|null **Timestamp of deletion, or null if not deleted**
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }
    // #endregion
    // #region Setters
    /**
     * **Sets the message ID.**
     *
     * @param int $messageId **Unique identifier for the message**
     *
     * @return void
     */
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * **Sets the associated chat ID.**
     *
     * @param int $chatId **ID of the chat to which this message belongs**
     *
     * @return void
     */
    public function setChatId(int $chatId): void
    {
        $this->chatId = $chatId;
    }

    /**
     * **Sets the user who sent the message.**
     *
     * @param User $user **User instance representing the sender**
     *
     * @return void
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * **Sets the content of the message.**
     *
     * @param string $content **Text content of the message**
     *
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * **Sets the sent timestamp.**
     *
     * @param int $sentAt **Unix timestamp of when the message was sent**
     *
     * @return void
     */
    public function setSentAt(int $sentAt): void
    {
        $this->sentAt = $sentAt;
    }

    /**
     * **Sets the soft delete timestamp.**
     * If the message is deleted, set this to the deletion timestamp; otherwise, set to `null`.
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