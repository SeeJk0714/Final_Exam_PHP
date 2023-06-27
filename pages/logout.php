<?php

    // instruction: if user session found, unset it
    unset($_SESSION['user']);


    // instruction: redirect user to home page
    header("Location: /");
    exit;
