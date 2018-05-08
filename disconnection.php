<?php
session_start();
session_id();
session_destroy();
header('Location: login.php');
