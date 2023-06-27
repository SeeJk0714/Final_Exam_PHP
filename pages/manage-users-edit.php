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
        <h1 class="h1">Edit User</h1>
    </div>
    <div class="card mb-2 p-4">
        <?php require 'parts/message_error.php'; ?>
        <form method="POST" action="users/edit">
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>">
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="">Select an option</option>
                    <option value="user" <?php echo ( $user['role'] === 'user' ? 'selected="selected"' : '' ); ?>>User</option>
                    <option value="admin" <?php echo ( $user['role'] === 'admin' ? 'selected="selected"' : '' ); ?>>Admin</option>
                </select>
            </div>
            <div class="d-grid">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <div class="text-center">
        <a href="/manage-users" class="btn btn-link link-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back to Users</a>
    </div>
</div>
<?php
    
    require 'parts/footer.php';