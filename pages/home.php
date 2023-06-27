<?php

    require 'parts/header.php';

?>
<div class="container my-5 mx-auto" style="max-width: 700px;">
    <h1 class="h1 mb-4 text-center">Online Quiz</h1>

    <div class="card p-4">
        <?php require dirname(__DIR__) .  '/parts/message_error.php'; ?>
        <?php require dirname(__DIR__) .  '/parts/message_success.php'; ?>
        <?php if ( isUserLoggedIn() ) : ?>
            <?php require dirname(__DIR__) .  '/parts/questions.php'; ?>
        <?php else : ?> 
            <p class="lead text-center mb-2 w-75 mx-auto">Please login with your existing account or sign up a new account to continue</p>
            <div class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3">
                <a href="/login" class="btn btn-primary px-5">Login</a>
                <a href="/signup" class="btn btn-primary px-5">Sign Up</a>
            </div>
        <?php endif; ?>
    </div>

    <?php if ( isUserLoggedIn() ) : ?>
        <div class="d-flex justify-content-center align-items-center gap-5 mx-auto mt-3">
            <?php if ( isCurrentUserAdmin() ) : ?>
                <a href="/dashboard" class="btn btn-link link-secondary btn-sm">Dashboard</a>
            <?php endif; ?>
            <a href="/logout" class="btn btn-link link-secondary btm-sm">Logout</a>
        </div>
    <?php endif; ?>

</div>
<?php

    require 'parts/footer.php';