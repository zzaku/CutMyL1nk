<?php

function logout()
{
    session_destroy();
    header('Location: ./index.php?page=home');
    exit();
}

?>