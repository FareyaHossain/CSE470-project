<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // ✅ Allow these fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'designation',
        'phone',
    ];
}


