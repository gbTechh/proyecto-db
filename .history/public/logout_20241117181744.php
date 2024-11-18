<?php
session_start();
session_destroy(); 
header("Location: /proyecto-db/public"); 
exit();
