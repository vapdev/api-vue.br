<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_paid',
        'view_count',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pixes()
    {
        return $this->hasMany(Pix::class);
    }

    public function userCourseHistories()
    {
        return $this->hasMany(UserCourseHistory::class);
    }

}