<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();


    
    // instruction: get questions
    $sql = "SELECT * FROM questions";
    $questions = $db->fetchAll($sql);



    require 'parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Questions</h1>
        <div class="text-end">
            <a href="/manage-questions-add" class="btn btn-primary btn-sm">Add New Question</a>
        </div>
    </div>
    <div class="card mb-2 p-4">
        <?php require dirname(__DIR__) .  '/parts/message_error.php'; ?>
        <?php require dirname(__DIR__) .  '/parts/message_success.php'; ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ( isset( $questions ) ) : ?>
                <?php foreach( $questions as $question ) : ?>
                    <tr>
                        <th scope="row"><?php echo $question['id']; ?></th>
                        <td><?php echo $question['question']; ?></td>
                        <td><?php echo $question['answer']; ?></td>
                        <td class="text-end">
                            <div class="buttons">
                                <a href="/manage-questions-edit?id=<?php echo $question['id']; ?>" class="btn btn-success btn-sm me-2"><i class="bi bi-pencil"></i></a>
                                <button href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-question-<?php echo $question['id']; ?>"><i class="bi bi-trash"></i></button>
                                <div class="modal fade" id="delete-question-<?php echo $question['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Question</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            Are you sure you want to delete this question (<?php echo $question['question']; ?>)?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form method="POST" action="questions/delete">
                                                <input type="hidden" name="id" value="<?php echo $question['id']; ?>">
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