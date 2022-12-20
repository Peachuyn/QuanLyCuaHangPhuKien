<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "sanpham";
    protected $fillable = [
        'SanPhamTen',
        'ChatLieuID',
        'ChatLieuID',
        'Mau',
        'Mota',
        'Gia',
        'SoLuong',
        'SoLuong_Ban',
        'ThoiGianTao',
        'HinhAnh',
        'SanPham_TinhTrang',
        'GiaCong',
        'CanNang',
        'Trash',
    ];
    protected $primaryKey = 'SanPhamID';
}
