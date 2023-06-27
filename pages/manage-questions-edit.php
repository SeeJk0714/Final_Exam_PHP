<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: if $_GET['id'] is not set, redirect to manage-questions.php
    if(!isset($_GET['id'])){
        header("Location: /manage-questions");
        exit;
    }


    // instruction: call DB class
    $db = new DB();

    

    // instruction: get question data
    $sql = "SELECT * FROM questions WHERE id = :id";
    $question = $db->fetch(
        $sql,
        [
            'id' => $_GET['id']
        ]
    );


    // if question is not found, redirect to manage-questions.php
    if ( !( isset( $question ) && $question ) ) {
        header( 'Location: /manage-questions.php' );
        exit;
    }

    require 'parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Question</h1>
    </div>
    <div class="card mb-2 p-4">
        <?php require dirname(__DIR__) .  '/parts/message_error.php'; ?>
        <form method="POST" action="questions/edit">
            <div class="mb-3">
                <label for="question" class="form-label">Question</label>
                <textarea class="form-control" id="question" name="question" rows="5"><?= $question['question']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Answer</label>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answer" 
                                id="answera" 
                                value="A"
                                <?php echo ( $question['answer'] === 'A' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="answera">
                                A
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answer" 
                                id="answerb" 
                                value="B"
                                <?php echo ( $question['answer'] === 'B' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="answerb">
                                B
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answer" 
                                id="answerc" 
                                value="C"
                                <?php echo ( $question['answer'] === 'C' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="answerc">
                                C
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="answer" 
                                id="answerd" 
                                value="D"
                                <?php echo ( $question['answer'] === 'D' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="answerd">
                                D
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <input type="hidden" name="id" value="<?= $question['id']; ?>" />
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <div class="text-center">
        <a href="/manage-questions" class="btn btn-link link-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back to Manage Questions</a>
    </div>
</div>
<?php
    
    require 'parts/footer.php';