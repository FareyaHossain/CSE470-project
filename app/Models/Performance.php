<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['staff_id', 'performance_metric', 'score', 'comments', 'date'];
    protected $casts = [
    'date' => 'date',
];

    public function staff()
    {
        return $this->belongsTo(Post::class, 'staff_id');
    }
}
