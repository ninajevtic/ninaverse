<div class="chat-container">
    <div class="conversations">
        <h3>Your Conversations</h3>
        <?php foreach ($conversations as $chat): ?>
            <div class="chat-item"><?= htmlspecialchars($chat['name']) ?></div>
        <?php endforeach; ?>
        <button id="load-more">Load More</button>
    </div>
    <div class="users">
        <h3>Available Users</h3>
        <?php foreach ($users as $user): ?>
            <div class="user-item"><?= htmlspecialchars($user['name']) ?></div>
        <?php endforeach; ?>
    </div>
    <div class="chat-content">
        <!-- Chat messages will be loaded here via AJAX -->
    </div>
</div>
