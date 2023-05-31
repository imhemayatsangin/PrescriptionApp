<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'patient', 'age', 'sex', 'prescription_date', 'diabetone', 'diabettwo', 'low_bp', 'high_bp', 'urine_output', 'respiratory', 'heart_rate', 'comment', 'instruction', 'temperature',
        'bmi', 'height', 'weight', 'clinical_record', 'user_id', 'status'
    ];

    use HasFactory;

    public function user()
    {

        return  $this->belongsTo(User::class);
    }

    // public function latestOrder()
    // {
    //     return $this->hasOne(Prescription::class)->latestOfMany();
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('type_id', 'dose', 'doseinterval_id', 'doseduration_id', 'timing_id', 'scheme_id')
            ->withTimestamps();
    }

    public function ScopeActive($query)
    {
        return $query->where('status', 1);
    }
}
