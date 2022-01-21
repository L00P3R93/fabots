<?php
session_start();
unset($_SESSION['bots_']);
session_destroy();
header('Location: ../sign_in');