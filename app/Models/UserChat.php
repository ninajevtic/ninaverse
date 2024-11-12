<?php

namespace Models;

class UserChat
{
    // #region Properties
    /** @var int UserChat ID */
    private $id;
    /** @var int Chat ID */
    private $chatId;
    /** @var int User ID */
    private $userId;
    /** @var string Joined timestamp */
    private $joinedAt;
    /** @var string|null Soft delete timestamp */
    private $deletedAt;
    // #endregion
    // #region Constructor
    public function __construct($id, $chatId, $userId, $joinedAt, $deletedAt)
    {
        $this->id = $id;
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->joinedAt = $joinedAt;
        $this->deletedAt = $deletedAt;
    }

    // #endregion
    // #region Getters
    public function getId()
    {
        return $this->id;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getJoinedAt()
    {
        return $this->joinedAt;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    // #endregion
    // #region Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setJoinedAt($joinedAt)
    {
        $this->joinedAt = $joinedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
    // #endregion
}
