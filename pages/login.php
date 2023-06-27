<?php

    // redirect user if already logged in
    if ( isUserLoggedIn() ) {
        header("Location: /");
        exit;
    }

    require 'parts/header.php';
?>
<div class="container my-5 mx-auto" style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center">Login</h1>

    <div class="card p-4">
        <?php require dirname(__DIR__) .  '/parts/message_error.php'; ?>
        <form method="POST" action="/auth/login">
            <div class="mb-2">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="email@example.com">
            </div>
            <div class="mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    <!-- links -->
    <div class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3">
        <a href="/" class="text-decoration-none small"><i class="bi bi-arrow-left-circle"></i> Go back</a>
        <a href="/signup" class="text-decoration-none small">Don't have an account? Sign up here <i class="bi bi-arrow-right-circle"></i></a>
    </div>
</div>
<?php

    require 'parts/footer.php';