<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'maju_career_applications';

    protected $fillable = [
        'career_job_id',
        'job_type',
        'name',
        'contact',
        'email',
        'linkedin_profile',
        'dob',
        'salary_desired',
        'postal_address',
        'city',
        'is_shortlisted',
        'is_rejected',
    ];

    // Relationships
    public function permanentFaculty()
    {
        return $this->hasOne(PermanentFaculty::class, 'application_id');
    }

    public function visitingFaculty()
    {
        return $this->hasOne(VisitingFaculty::class, 'application_id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'application_id');
    }
    public function job()
    {
    return $this->belongsTo(CareerJob::class, 'career_job_id');
    }

}
