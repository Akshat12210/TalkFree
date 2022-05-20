<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
if (session_destroy()) {

    header('Location:index.php');
}
?>

</body>
</html>