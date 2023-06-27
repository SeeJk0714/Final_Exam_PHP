<?php

    // redirect to login page if user is not logged in
    if ( !isUserLoggedIn() ) {
        header( 'Location: /login' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();


    // instruction: get all the questions
    $sql = "SELECT * FROM questions";
    $questions = $db->fetchAll($sql);


    // loop through all the questions to make sure all the answers are set
    foreach ( $questions as $question ) {
        // instruction: if answer is not set, set $error
        if ( !isset( $_POST['q' . $question['id']] ) ) {
            $error = "Please enter your question.";
        }
    }

    // if $error is set, redirect to home page
    if ( isset( $error ) ) {
        $_SESSION['error'] = $error;
        header( 'Location: /' );
        exit;
    }

    // loop through all the questions to insert / update the answer to the database
    foreach ( $questions as $question ) {
        // check if the answer is already in the database
        $answer = $db->fetch(
            'SELECT * FROM results WHERE user_id = :user_id AND question_id = :question_id',
            [
                'user_id' => $_SESSION['user']['id'],
                'question_id' => $question['id']
            ]
        );

        // if answer is already in the database, update the answer
        if ( $answer ) {
            // instruction: call the $db->update() method to update the answer
            $sql = "UPDATE results SET  answer = :answer WHERE question_id = :question_id AND user_id = :user_id";
            $db->update(
                $sql,
                [
                    'answer' => $_POST['q' . $question['id']],
                    'question_id' => $question['id'],
                    'user_id' => $_SESSION['user']['id']
                ]
            );
            
        } else {
            // if answer is not in the database, insert the answer
            // instruction: call the $db->insert() method to insert the answer
            $sql = "INSERT INTO results (`question_id`, `answer`, `user_id`) VALUES (:question_id, :answer, :user_id)";
            $db->insert(
                $sql,
                [
                    'question_id' => $question['id'],
                    'answer' => $_POST['q' . $question['id']],
                    'user_id' => $_SESSION['user']['id']
                ]
            );

        }
    }

    // set success message
    $_SESSION['success'] = 'Your answers have been submitted';

    // instruction: redirect to home page
    header( 'Location: /' );
    exit;
    