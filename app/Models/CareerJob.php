<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerJob extends Model
{

    protected $table = 'career_jobs';

    protected $fillable = [
        'title', 'contact', 'job_type', 'description', 'status'
    ];

    public function applications()
    {
    return $this->hasMany(Application::class, 'career_job_id');
    }


}
