<?php
require 'DBconnector.php';

session_unset();
session_destroy();
session_write_close();

header('Location: login.php');
exit();
?>