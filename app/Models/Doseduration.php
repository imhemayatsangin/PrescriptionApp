<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doseduration extends Model
{
    protected $fillable = ['name', 'pashto_name', 'description', 'user_id', 'status'];
    use HasFactory;

    public function user()
    {

        return  $this->belongsTo(User::class);
    }
    public function ScopeActive($query)
    {
        return $query->where('status', 1);
    }
}
