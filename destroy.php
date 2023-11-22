<?php
session_start();
ob_start();

if(session_status() == 2) {
    session_destroy();
    session_reset();
    print "Session destroyed!";
} else {
    print "No Active session!";
}

ob_end_flush();
?>