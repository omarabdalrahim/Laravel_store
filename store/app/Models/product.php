<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name','slug','description','image','category_id','store_id',
        'price','comare_price','status',
    ];


    protected static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder){
            $user = Auth::user();
            if($user && $user->store_id){
            $builder->where('store_id','=',$user->store_id);
            }
        });

        // static::creating(function(Product $product) {
        //     $product->slug = Str::slug($product->name);
        // });
    }


    public function category()
    {

        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function store()
    {

        return $this->belongsTo(Category::class,'store_id','id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // Related Model
            'product_tag',  // Pivot table name  (الجدول الوسيط)
            'product_id',   // FK in pivot table for the current model
            'tag_id',       // FK in pivot table for the related model
            'id',           // PK current model
            'id'            // PK related model
        );
    }
    public function scopeActive(Builder $builder)
    {
          $builder->where('status','=','active');
    }


     // Accessors
    // $product->image_url

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * $this->price / $this->compare_price), 1);
    }
}
