<?php

function isUserLoggedIn() {
    return ( isset( $_SESSION['user'] ) ? true : false );
}

function isCurrentUserAdmin() {
    return ( isset( $_SESSION['user']['role'] ) && $_SESSION['user']['role'] === 'admin' ? true : false );
}