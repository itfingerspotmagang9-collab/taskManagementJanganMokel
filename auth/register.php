<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sekarang Jugaa</title>
</head>
<body>
    <div class="form_register">
        <form action="function.php" method="post">
            <table>
                <tr>
                    <td>Nama : </td>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
            </table>
            
            <input type="email" name="email" id="email">
            <input type="password" name="password" id="password">
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>