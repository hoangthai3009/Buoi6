<?php
require_once("Nhanvien.class.php");

if (!isset($_GET['id'])) {
    echo "ID không được xác định.";
    exit();
}

$id = $_GET['id'];

$nv = Nhanvien::getById($id);

session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "Bạn không có quyền truy cập trang này.";
    exit();
}

if (isset($_POST['submit_edit'])) {
    $maNV = $_POST['Ma_NV'];
    $tenNV = $_POST['Ten_NV'];
    $phai = $_POST['Phai'];
    $noiSinh = $_POST['Noi_Sinh'];
    $maPhong = $_POST['Ma_Phong'];
    $luong = $_POST['Luong'];

    $nhanvien = new Nhanvien($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong);
    $result = $nhanvien->update();
    if ($result) {
        echo "<script>alert('Cập nhật nhân viên thành công');</script>";
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Cập nhật nhân viên thất bại');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa nhân viên</title>
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
    <h2 style="text-align: center">Sửa nhân viên</h2>
    <form method="post" action="">
        <label for="MaNV">Mã NV:</label>
        <input type="text" id="MaNV" name="MaNV" value="<?php echo $nv['Ma_NV']; ?>" readonly><br>
        <label for="TenNV">Tên NV:</label>
        <input type="text" id="TenNV" name="TenNV" value="<?php echo $nv['Ten_NV']; ?>"><br>
        <label>Giới tính:</label><br>
        <input type="radio" id="Nam" name="Phai" value="Nam" <?php echo ($nv['Phai'] == 'NAM') ? 'checked' : ''; ?>>
        <label for="Nam">Nam</label>
        <input type="radio" id="Nu" name="Phai" value="Nữ" <?php echo ($nv['Phai'] == 'NU') ? 'checked' : ''; ?>>
        <label for="Nu">Nữ</label><br>
        <label for="NoiSinh">Nơi sinh:</label>
        <input type="text" id="NoiSinh" name="NoiSinh" value="<?php echo $nv['Noi_Sinh']; ?>"><br>
        <label for="MaPhong">Mã Phòng:</label>
        <input type="text" id="MaPhong" name="MaPhong" value="<?php echo $nv['Ma_Phong']; ?>"><br>
        <label for="Luong">Lương:</label>
        <input type="text" id="Luong" name="Luong" value="<?php echo $nv['Luong']; ?>"><br>
        <input type="submit" name="submit_edit" value="Cập nhật">
    </form>
</body>

</html>