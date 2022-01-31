<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'deadline',
        'workspace_id',
        'date_complete',
        'user_id',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeIncomplete($query)
    {
        return $query->where('status', 0);
    }

    public function scopeComplete($query)
    {
        return $query->where('status', 1);
    }

    public function getDeadlineDateAttribute()
    {
        return Carbon::parse($this->deadline)->format('Y-m-d');
    }

    public function getDeadlineDueAttribute()
    {
        return Carbon::parse($this->deadline)->diffForHumans();
    }

    public function getCompleteDueAttribute()
    {
        return Carbon::parse($this->date_complete)->diffForHumans();
    }
}
