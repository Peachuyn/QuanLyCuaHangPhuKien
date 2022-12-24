<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistChiTiet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "wishlist_chitiet";
    protected $fillable = [
        'WishlistID',
        'SanPhamID',

    ];
    protected $primaryKey = 'WishlistChiTietID';
    public function product()
    {
        return $this->hasMany(Product::class, 'SanPhamID');
    }
}
