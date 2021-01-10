<?php

class ExitController
{
    public function exitAction()
    {
        unset($_SESSION['user_id']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}