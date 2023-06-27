<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    require 'parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 1080px;">
    <h1 class="h1 mb-4 text-center">Dashboard</h1>
    <?php require 'parts/message_success.php'; ?>
    <div class="row">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <div class="mb-1">
                            <i class="bi bi-question-square" style="font-size: 3rem;"></i>
                        </div>
                        Manage Questions
                    </h5>
                    <div class="text-center mt-3">
                        <a href="/manage-questions" class="btn btn-primary btn-sm">Access</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <div class="mb-1">
                            <i class="bi bi-people" style="font-size: 3rem;"></i>
                        </div>
                        Manage Users
                    </h5>
                    <div class="text-center mt-3">
                        <a href="/manage-users" class="btn btn-primary btn-sm">Access</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <div class="mb-1">
                            <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                        </div>
                        View Results
                    </h5>
                    <div class="text-center mt-3">
                        <a href="/results" class="btn btn-primary btn-sm">Access</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 text-center">
        <a href="/" class="btn btn-link link-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
</div>
<?php
    
    require 'parts/footer.php';