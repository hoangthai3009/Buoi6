<?php
require_once("nhanvien.class.php");

if (isset($_POST['submit_add'])) {
    $maNV = $_POST['MaNV'];
    $tenNV = $_POST['TenNV'];
    $phai = $_POST['Phai'];
    $noiSinh = $_POST['NoiSinh'];
    $maPhong = $_POST['MaPhong'];
    $luong = $_POST['Luong'];

    $nhanvien = new Nhanvien($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong);
    $result = $nhanvien->save();
    if ($result) {
        echo "<script>alert('Thêm nhân viên thành công');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Thêm nhân viên thất bại');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Thêm nhân viên</h2>
    <form method="post" action="">
        <label for="MaNV">Mã NV:</label>
        <input type="text" id="MaNV" name="MaNV" required><br>
        <label for="TenNV">Tên NV:</label>
        <input type="text" id="TenNV" name="TenNV" required><br>
        <label>Giới tính:</label><br>
        <input type="radio" id="Nam" name="Phai" value="Nam" required>
        <label for="Nam">Nam</label>
        <input type="radio" id="Nu" name="Phai" value="Nữ" required>
        <label for="Nu">Nữ</label><br>
        <label for="NoiSinh">Nơi sinh:</label>
        <input type="text" id="NoiSinh" name="NoiSinh" required><br>
        <label for="MaPhong">Mã Phòng:</label>
        <input type="text" id="MaPhong" name="MaPhong" required><br>
        <label for="Luong">Lương:</label>
        <input type="text" id="Luong" name="Luong" required><br>
        <input type="submit" name="submit_add" value="Thêm">
    </form>
</body>

</html>