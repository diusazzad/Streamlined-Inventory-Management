<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'short_code',
    ];

    /**
     * Get all of the comments for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
