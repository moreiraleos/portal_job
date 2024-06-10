<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $fillable = [
        'id',
        'job_title',
        'job_region',
        'job_type',
        'vacancy',
        'experience',
        'company_name',
        'published_on',
        'salary',
        'gender',
        'application_deadline',
        'job_description',
        'responsibilities',
        'education',
        'category',
        'other_benefitis',
        'education_experience',
        'image',
    ];

    public $timestamps = true;
}
