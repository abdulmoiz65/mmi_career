<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'application_id',
        'gender',
        'post_applied',
        'join_date',
        'highest_degree',
        'specialization',
        'institute',
        'passing_year',
        'org_recent',
        'designation_recent',
        'date_of_joining',
        'years_experience',
        'resume',
        'photo',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}