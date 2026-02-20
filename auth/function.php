<?php
session_start();
require "../config/database.php";
function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasi = mysqli_real_escape_string($conn, $data["konfirmasi"]);

    // 1. Cek apakah username sudah ada di database
    $query_cek = "SELECT username FROM users WHERE username = ?";
    $stmt_cek = mysqli_prepare($conn, $query_cek);
    mysqli_stmt_bind_param($stmt_cek, "s", $username);
    mysqli_stmt_execute($stmt_cek);
    
    // Ambil hasilnya
    mysqli_stmt_store_result($stmt_cek);
    if (mysqli_stmt_num_rows($stmt_cek) > 0) {
        echo "<script>alert('Username sudah terdaftar!');</script>";
        return false;
    }

    // 2. Cek kesesuaian password
    if ($password !== $konfirmasi) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
        return false;
    }

    // 3. Enkripsi password (WAJIB demi keamanan)
    $password_baru = password_hash($password, PASSWORD_DEFAULT);

    // 4. Tambahkan user baru ke database menggunakan Prepared Statement
    $query_ins = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt_ins = mysqli_prepare($conn, $query_ins);
    
    // "ss" karena username dan password_baru adalah String
    mysqli_stmt_bind_param($stmt_ins, "ss", $username, $password_baru);
    mysqli_stmt_execute($stmt_ins);

    return mysqli_stmt_affected_rows($conn);
}