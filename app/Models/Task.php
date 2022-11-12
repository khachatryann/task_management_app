<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'created_by',
        'status_id',
        'assign_to',
        'description',
        'created_at'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
