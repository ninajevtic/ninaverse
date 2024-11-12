<?php

namespace Models;

class Chat
{
    // #region Properties
    /** @var int Chat ID */
    private $chatId;
    /** @var string|null Name of the chat */
    private $name;
    /** @var string Type of the chat (public or private) */
    private $chatType;
    /** @var int ID of the user who created the chat */
    private $createdBy;
    /** @var string Creation timestamp */
    private $createdAt;
    /** @var string Update timestamp */
    private $updatedAt;
    /** @var string|null Soft delete timestamp */
    private $deletedAt;
    // #endregion
    // #region Constructor
    public function __construct(
        $chatId,
        $name,
        $chatType,
        $createdBy,
        $createdAt,
        $updatedAt,
        $deletedAt
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
    public function getChatId()
    {
        return $this->chatId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getChatType()
    {
        return $this->chatType;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
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
    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setChatType($chatType)
    {
        $this->chatType = $chatType;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
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
