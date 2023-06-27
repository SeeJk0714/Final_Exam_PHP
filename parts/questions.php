<?php

    $db = new DB();

    // instruction: Get all the questions
    $sql = "SELECT * FROM questions";
    $questions = $db->fetchAll($sql);


    // check if current user has already answered the questions
    $answered = $db->fetchAll(
        "SELECT * FROM results WHERE user_id = :user_id",
        [
            'user_id' => $_SESSION['user']['id']
        ]
    );

?>
<form
    method="POST"
    action="/questions/answer">
    <!-- Loop through all the questions -->
    <?php if ( isset( $questions ) ) : ?>
        <?php foreach( $questions as $index => $question ) :
            // get the answer of the current user if answered
            $user_answer = $db->fetch(
                "SELECT * FROM results WHERE user_id = :user_id AND question_id = :question_id",
                [
                    'user_id' => $_SESSION['user']['id'],
                    'question_id' => $question['id']
                ]
            );
            ?>
            <div class="mb-5">
                <label for="role" class="form-label fw-bold"><?= ($index+1); ?>. <?= $question['question']; ?></label>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="q<?= $question['id']; ?>" 
                                id="qa_<?= $question['id']; ?>" 
                                value="A"
                                <?php echo ( isset( $user_answer['answer'] ) && $user_answer['answer'] === 'A' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="qa_<?= $question['id']; ?>">
                                A
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="q<?= $question['id']; ?>"  
                                id="qb_<?= $question['id']; ?>" 
                                value="B"
                                <?php echo ( isset( $user_answer['answer'] ) && $user_answer['answer'] === 'B' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="qb_<?= $question['id']; ?>">
                                B
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="q<?= $question['id']; ?>"  
                                id="qc_<?= $question['id']; ?>" 
                                value="C"
                                <?php echo ( isset( $user_answer['answer'] ) && $user_answer['answer'] === 'C' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="qc_<?= $question['id']; ?>">
                                C
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="radio" 
                                name="q<?= $question['id']; ?>"  
                                id="qd_<?= $question['id']; ?>" 
                                value="D"
                                <?php echo ( isset( $user_answer['answer'] ) && $user_answer['answer'] === 'D' ? 'checked="checked"' : '' ); ?>
                                >
                            <label class="form-check-label w-100" for="qd_<?= $question['id']; ?>">
                                D
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">
            <?= ( count($answered) > 0 ? 'Update' : 'Submit' ); ?> 
        </button>
    </div>
</form>