<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = "applyedjobs";

    protected $fillable = [
        'id',
        'user_id',
        'company_image',
        'location',
        'email',
        'job_type',
        'job_id',
        'company_name',
        'cv',
        'job_title'
    ];

    public $timestamps = true;
}
