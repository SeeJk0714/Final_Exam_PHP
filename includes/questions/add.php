<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();


    // instruction: get all POST data
    $question = $_POST['question'];
    $answer = $_POST['answer'];


    /* 
        instruction: do error checking 
        - make sure all the fields are not empty
    */
    if( empty($question) || empty($answer)){
        $error = " All fields are required.";

    }


    // if error found, set error message session & redirect user back to /manage-questions-add page
    if( isset ($error)){
        $_SESSION['error'] = $error;
        header("Location: /manage-questions-add?id=$id");    
        exit;
    } 

    // instruction: add new question
    $sql = "INSERT INTO questions (`question`, `answer`) VALUES (:question, :answer)";
    $db->insert(
        $sql,
        [
            'question' => $question,
            'answer' => $answer
        ]
    );


    // set success message
    $_SESSION["success"] = "Question added";

    // instruction: redirect user back to manage-questions page
    header("Location: /manage-questions");    
    exit;
