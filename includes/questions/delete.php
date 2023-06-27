<?php

    // redirect to home page if user is not admin
    if ( !isCurrentUserAdmin() ) {
        header( 'Location: /' );
        exit;
    }

    // instruction: call DB class
    $db = new DB();


    // instruction: get all POST data
    $id = $_POST["id"];


    // maks sure id is not empty
    if ( empty( $id ) ) {
        $_SESSION['error'] = "Question ID is required";

        // redirect user back to manage-questions page
        header("Location: /manage-questions");
        exit;
    }

    // instruction: delete question
    $sql = "DELETE FROM questions WHERE id = :id";
    $db->delete(
        $sql,
        [
            'id' => $id
        ]
    );



    // set success message
    $_SESSION["success"] = "Question deleted";

    // instruction: redirect user back to manage-questions page
    header("Location: /manage-questions");
        exit;
    
    