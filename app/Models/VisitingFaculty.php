<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitingFaculty extends Model
{
    use HasFactory;

    protected $table = 'visiting_faculty';

    protected $fillable = [
        'application_id',
        'gender',
        'join_date',
        'highest_degree',
        'specialization',
        'institute',
        'passing_year',
        'dept',
        'post_applied',
        'org_recent',
        'designation_recent',
        'years_academia',
        'years_industry',
        'photo',
        'resume',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}