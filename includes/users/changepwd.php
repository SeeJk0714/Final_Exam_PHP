<?php

    // instruction: redirect to home page if user is not admin
    if( !isCurrentUserAdmin()){
        header("Location: /");
        exit;
    }


    // instruction: call DB class
    $db = new DB();
  


    // instruction: get all POST data
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $id = $_POST['id'];


    /* 
        instruction: do error checking 
        - make sure all the required fields are not empty
        - make sure password is match
        - make sure password is at least 8 characters
    */
    if(empty($password) || empty($confirm_password) || empty($id)){
        $error = " All fields are required.";

    }else if( $password !== $confirm_password){
        $error = "The password is not match.";

    }else if(strlen($password) < 8){
        $error = "The password must be at least 8 characters.";

    }



    // instruction: if error found, set error message session & redirect user back to /manage-users-changepwd page
    if(isset($error)){
        $_SESSION['error'] = $error;

        header("Location: /manage-users-changepwd?id=$id");
        exit;
    }



    // instruction: if no error found, process to account update
    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $db->update(
        $sql,
        [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'id' => $id
        ]);



    // set success message into session
    $_SESSION["success"] = "Password has been updated successfully";

    // instruction: redirect user to /manage-users page
    header("Location: /manage-users");
    exit;

