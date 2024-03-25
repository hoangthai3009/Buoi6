<?php
require_once("nhanvien.class.php");
session_start();

if (isset($_GET['delete'])) {
    $maNV = $_GET['delete'];
    $nhanvien = new Nhanvien($maNV, '', '', '', '', '');
    $result = $nhanvien->delete();
}

$recordsPerPage = 5;
$totalRecords = count(Nhanvien::list());
$totalPages = ceil($totalRecords / $recordsPerPage);

if (!isset($_GET['page'])) {
    $currentPage = 1;
} else {
    $currentPage = $_GET['page'];
}

$startIndex = ($currentPage - 1) * $recordsPerPage;

$list_nhanvien = Nhanvien::listPerPage($startIndex, $recordsPerPage);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .add-link {
            margin-bottom: 10px;
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-link:hover {
            background-color: #45a049;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        .add-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h3>Danh sách nhân viên
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <a href="add.php" class="add-button">Thêm nhân viên</a>
            <br>
        <?php endif; ?>
    </h3>
    <table border='1'>
        <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Phái</th>
            <th>Nơi Sinh</th>
            <th>Mã Phòng</th>
            <th>Lương</th>
            <?php if ($_SESSION['role'] == 'admin') : ?>
                <th>Chức năng</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($list_nhanvien as $nv) : ?>
            <tr>
                <td><?php echo $nv['Ma_NV']; ?></td>
                <td><?php echo $nv['Ten_NV']; ?></td>
                <td>
                    <?php
                    if ($nv['Phai'] == 'NU') {
                        echo '<img src="woman.jpg" alt="Woman" height="20">';
                    } else {
                        echo '<img src="man.jpg" alt="Man" height="20">';
                    }
                    ?>
                </td>
                <td><?php echo $nv['Noi_Sinh']; ?></td>
                <td><?php echo $nv['Ma_Phong']; ?></td>
                <td><?php echo $nv['Luong']; ?></td>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                    <td>
                        <a href="edit.php?id=<?php echo $nv['Ma_NV']; ?>">Sửa</a> |
                        <a href="?delete=<?php echo $nv['Ma_NV']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">Xóa</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($currentPage == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

</body>

</html>