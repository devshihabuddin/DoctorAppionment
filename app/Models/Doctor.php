<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_id',
        'name',
        'phone',
        'fee',
        'status'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
