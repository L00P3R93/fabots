<?php
    session_start();
    if(isset($_SESSION['bots_'])){
        header('Location: dashboard');
    }