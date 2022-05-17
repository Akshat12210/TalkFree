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

    header('Location:signup.php');
}
?>

</body>
</html>