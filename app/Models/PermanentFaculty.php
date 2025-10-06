<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentFaculty extends Model
{
    use HasFactory;

    protected $table = 'permanent_faculty';

    protected $fillable = [
        'application_id',
        'highest_degree',
        'specialization',
        'institute',
        'passing_year',
        'post_applied',
        'org_recent',
        'designation_recent',
        'resume',
        'degree_certificate',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
