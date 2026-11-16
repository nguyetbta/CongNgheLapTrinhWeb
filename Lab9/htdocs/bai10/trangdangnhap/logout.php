<?php
session_start();

// Huy tat ca SESSION
session_destroy();

echo "<script>
        alert('Logout Successfull!');
        location.href='index.php';
      </script>";
?>