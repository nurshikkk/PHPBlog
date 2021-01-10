<?php
session_start();
unset($_SESSION['user_id']);
header('Location: ' . $_SERVER['HTTP_REFERER']);
