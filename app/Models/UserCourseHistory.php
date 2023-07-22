<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_video_id',
        'watched',
        'paid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseVideo()
    {
        return $this->belongsTo(CourseVideo::class);
    }

}