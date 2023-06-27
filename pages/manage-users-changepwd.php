<?php

     // redirect to home page if user is not admin
     if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: if $_GET['id'] is not set, redirect to manage-users.php
    if(!isset($_GET['id'])){
        header("Location: /manage-users");
        exit;
    }


    // instruction: call DB class
    $db = new DB();



    // instruction: get user data
    $sql = "SELECT * FROM users WHERE id = :id";
    $user = $db->fetch(
        $sql,
        [
            'id' => $_GET['id']
        ]
    );
    

    // if user is not found, redirect to manage-users.php
    if ( !( isset( $user ) && $user ) ) {
        header( 'Location: /manage-users.php' );
        exit;
    }

    require 'parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Change Password for User (<?= $user['name'] ?>)</h1>
    </div>
    <div class="card mb-2 p-4">
        <?php require 'parts/message_error.php'; ?>
        <form method="POST" action="users/changepwd">
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm_password">
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>
    <div class="text-center">
        <a href="/manage-users" class="btn btn-link link-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back to Users</a>
    </div>
</div>
<?php
    
    require 'parts/footer.php';