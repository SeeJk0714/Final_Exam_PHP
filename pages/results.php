<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // call DB class
    $db = new DB();

    // instruction: get all users
    $sql = "SELECT * FROM users";
    $users = $db->fetchAll($sql);


    // instruction: get all the questions
    $sql = "SELECT * FROM questions";
    $questions = $db->fetchAll($sql);


    require 'parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">View Results</h1>
    </div>
    <div class="card mb-2 p-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Results</th>
                </tr>
            </thead>
            <tbody>
            <?php if ( isset( $users ) ) : ?>
                <?php 
                    foreach( $users as $user ) : 
                        // instruction: get user results by user id
                        $sql = "SELECT * FROM results WHERE user_id = :user_id";
                        $results = $db->fetchAll(
                            $sql,
                            [
                                'user_id' => $user['id']
                            ]
                        );


                        // get total score
                        $total_score = 0;

                        // compare user answers with correct answers
                        if ( isset( $results ) ) {
                            foreach( $results as $result ) {
                                // instruction: get question by id
                                $sql = "SELECT * FROM questions WHERE id = :id";
                                $question = $db->fetch(
                                    $sql,
                                    [
                                        'id' => $result['question_id']
                                    ]
                                );
    

                                // compare user answer with correct answer
                                if ( isset( $question['answer'] ) && $question['answer'] == $result['answer'] ) {
                                    $total_score++;
                                }
                            }
                        }

                    ?>
                    <tr>
                        <th scope="row"><?php echo $user['id']; ?></th>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <!-- if no results, show n/a -->
                            <?php if ( !( isset( $results ) && count( $results ) > 0 ) ) : ?>
                                n/a
                            <?php else : ?>
                                <!-- show total score if contain results -->
                                <?php echo $total_score; ?> / <?php echo ( isset( $question ) ? count( $questions ) : 0 ); ?>
                            <?php endif; ?>
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