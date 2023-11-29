<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

// بمنع لارفيل من اضافته في حالة الغاءه
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug'
    ];

    // لا يتم تمرير القيم في حالة الالتزام بالتسميه تيع لارفيل
  public function products()
  {
    return $this->belongsToMany(product::class);
  }
}
