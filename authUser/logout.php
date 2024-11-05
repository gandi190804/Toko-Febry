<?php
session_start();
unset($_SESSION['loginUser']);
$_SESSION['loginUser'] = null;
header('Location: ../');