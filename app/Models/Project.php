<?php

namespace App\Models;

use App\Concerns\HasUniqueNumber;
use App\Concerns\HasUuid;
use App\Enums\ProjectSector;
use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectsFactory> */
    use HasFactory, HasUniqueNumber, HasUuid, SoftDeletes;

    const UNIQUE_NUMBER_PREFIX = 'PR';

    protected $casts = [
        'scope' => ProjectType::class,
        'sector' => ProjectSector::class,
        'status' => ProjectStatus::class,
        'longitude' => 'float',
        'latitude' => 'float',
        'installation_scheduled_at' => 'date',
        'installation_completed_at' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
