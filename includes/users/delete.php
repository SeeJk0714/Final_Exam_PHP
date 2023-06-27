<?php

    // instruction: redirect to home page if user is not admin
    if( !isCurrentUserAdmin()){
        header("Location: /");
        exit;
    }


    // instruction: call DB class
    $db = new DB();
    


    // instruction: get all POST data
    $id = $_POST["id"];


    /* 
        instruction:  do error checking
        - make sure user id is not empty
        - if empty, set error message session & redirect user back to manage-users page
    */
    if (empty($id)){
        $_SESSION['error'] = "ERROR";
        header("Location: /manage-users");
        exit;
    }


    // instruction: if no error found, process to account deletion
    $sql = "DELETE FROM users WHERE id = :id";
    $db->delete(
        $sql,
        [
            'id' => $id
        ]
    );



    // set success message into session
    $_SESSION["success"] = "User has been deleted";

    // instruction: redirect user back to /manage-users page
    header("Location: /manage-users");
    exit;
