<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();

    

    // instruction: get users
    $sql = "SELECT * FROM users";
    $users = $db->fetchAll($sql);



    require 'parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Users</h1>
        <div class="text-end">
            <a href="/manage-users-add" class="btn btn-primary btn-sm">Add New User</a>
        </div>
    </div>
    <div class="card mb-2 p-4">
        <?php require dirname(__DIR__) .  '/parts/message_error.php'; ?>
        <?php require dirname(__DIR__) .  '/parts/message_success.php'; ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ( isset( $users ) ) : ?>
                <?php foreach( $users as $user ) : ?>
                    <tr>
                        <th scope="row"><?= $user['id']; ?></th>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td>
                        <?php
                            switch( $user['role'] ) {
                                case 'admin':
                                    echo '<span class="badge bg-primary">Admin</span>';
                                    break;
                                default:
                                    echo '<span class="badge bg-success">User</span>';
                                    break;
                            }
                        ?>
                        </td>
                        <td class="text-end">
                            <div class="buttons">
                                <a href="/manage-users-edit?id=<?= $user['id']; ?>" class="btn btn-success btn-sm me-2"><i class="bi bi-pencil"></i></a>
                                <a href="/manage-users-changepwd?id=<?= $user['id']; ?>" class="btn btn-warning btn-sm me-2"><i class="bi bi-key"></i></a>
                                <button href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-user-<?= $user['id']; ?>"><i class="bi bi-trash"></i></button>
                                <div class="modal fade" id="delete-user-<?= $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Are you sure you want to delete this user (<?= $user['name']; ?>)?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form method="POST" action="users/delete">
                                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="text-center">
        <a href="/dashboard" class="btn btn-link link-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
    </div>
</div>
<?php
    
    require 'parts/footer.php';