<?php
require_once("db.class.php");
class Nhanvien
{
    public $MaNV;
    public $TenNV;
    public $Phai;
    public $NoiSinh;
    public $MaPhong;
    public $Luong;

    public function __construct($MaNV, $TenNV, $Phai, $NoiSinh, $MaPhong, $Luong)
    {
        $this->MaNV = $MaNV;
        $this->TenNV = $TenNV;
        $this->Phai = $Phai;
        $this->NoiSinh = $NoiSinh;
        $this->MaPhong = $MaPhong;
        $this->Luong = $Luong;
    }

    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$this->MaNV', '$this->TenNV', '$this->Phai', '$this->NoiSinh', '$this->MaPhong', '$this->Luong')";
        $result = $db->query_execute($sql);
        return $result;
    }

    public function delete()
    {
        $db = new Db();
        $sql = "DELETE FROM nhanvien WHERE Ma_NV = '$this->MaNV'";
        $result = $db->query_execute($sql);
        return $result;
    }

    public function update()
    {
        $db = new Db();
        $sql = "UPDATE nhanvien SET Ten_NV = '$this->TenNV', Phai = '$this->Phai', Noi_Sinh = '$this->NoiSinh', Ma_Phong = '$this->MaPhong', Luong = '$this->Luong' WHERE Ma_NV = '$this->MaNV'";
        $result = $db->query_execute($sql);
        return $result;
    }

    public static function list()
    {
        $db = new Db();
        $sql = "SELECT * FROM nhanvien";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function listPerPage($startIndex, $recordsPerPage)
    {
        $db = new Db();
        $sql = "SELECT * FROM nhanvien LIMIT $startIndex, $recordsPerPage";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function getById($id)
    {
        $db = new Db();
        $sql = "SELECT * FROM nhanvien WHERE Ma_NV = '$id'";
        $result = $db->select_to_array($sql);
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }
}
