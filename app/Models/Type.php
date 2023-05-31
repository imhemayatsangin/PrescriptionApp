<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'status'];

    public function user()
    {

        return  $this->belongsTo(User::class);
    }


    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }


    public function ScopeActive($query)
    {
        return $query->where('status', 1);
    }

    use HasFactory;
}
