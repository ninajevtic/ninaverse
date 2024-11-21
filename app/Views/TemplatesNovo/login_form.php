<form action="<?= htmlspecialchars($params['action'] ?? '/login') ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($params['csrf_token'] ?? '') ?>">

    <div class="form-outline mb-4">
        <input type="email" id="email" name="email" class="form-control form-control-lg"
               placeholder="Enter your email" required />
        <label class="form-label" for="email">Email address</label>
    </div>

    <div class="form-outline mb-3">
        <input type="password" id="password" name="password" class="form-control form-control-lg"
               placeholder="Enter your password" required />
        <label class="form-label" for="password">Password</label>
    </div>

    <div class="text-center text-lg-start mt-4 pt-2">
        <button type="submit" class="btn btn-primary btn-lg">Login</button>
    </div>
</form>
