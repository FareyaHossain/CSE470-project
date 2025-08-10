<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'start_date',
        'end_date',
        'reason',
        'status',
        'admin_comment',
    ];

    public function staff() {
        return $this->belongsTo(Post::class, 'staff_id');
    }
}




