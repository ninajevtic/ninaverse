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
<div class="chat-container">
    <?php foreach ($conversations as $conversation): ?>
        <div class="chat-message">
            <?= htmlspecialchars($conversation['message']) ?>
        </div>
    <?php endforeach; ?>
</div>
<script>
    // AJAX funkcija za učitavanje dodatnih razgovora
    function loadMore() {
        fetch('/ninaverse/chat/load-more', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ page: 2 })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
    }
</script>
