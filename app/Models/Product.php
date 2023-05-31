<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['brand_id', 'type_id', 'product_name', 'dose', 'package', 'status', 'user_id'];
    use HasFactory;

    public function user()
    {

        return  $this->belongsTo(User::class);
    }
    public function brand()
    {

        return  $this->belongsTo(Brand::class);
    }
    public function type()
    {

        return  $this->belongsTo(Type::class);
    }

    public function interval()
    {

        return  $this->belongsTo(Type::class);
    }
    public function ScopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class);
    }
}
