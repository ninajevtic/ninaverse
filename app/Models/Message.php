<?php

namespace Models;

class Message
{
    // #region Properties
    /** @var int Message ID */
    private $messageId;
    /** @var int Chat ID associated with this message */
    private $chatId;
    /** @var int User ID who sent the message */
    private $userId;
    /** @var string Content of the message */
    private $content;
    /** @var string Sent timestamp */
    private $sentAt;
    /** @var string|null Soft delete timestamp */
    private $deletedAt;
    // #endregion
    // #region Constructor
    public function __construct(
        $messageId,
        $chatId,
        $userId,
        $content,
        $sentAt,
        $deletedAt
    ) {
        $this->messageId = $messageId;
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->content = $content;
        $this->sentAt = $sentAt;
        $this->deletedAt = $deletedAt;
    }

    // #endregion
    // #region Getters
    public function getMessageId()
    {
        return $this->messageId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getSentAt()
    {
        return $this->sentAt;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    // #endregion
    // #region Setters
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
    // #endregion
}
