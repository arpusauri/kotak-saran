<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'category',
        'message',
        'response',
        'status',
        'admin_id',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function activities()
    {
        return $this->hasMany(ActivityLog::class);
    }
}

?>