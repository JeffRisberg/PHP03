<?php
if (!$result = mysqli_close($db_connection)) {
    die('There was an error disconnecting');
}
?>