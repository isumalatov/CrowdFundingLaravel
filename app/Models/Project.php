<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'publication_date',
        'completion_date',
        'required_funds',
    ];

    protected $casts = [
        'publication_date' => 'datetime',
        'completion_date' => 'datetime',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function getFundsRaisedAttribute()
    {
        return $this->contributions->sum('amount');
    }

    public function getStatusAttribute()
    {
        return $this->funds_raised >= $this->required_funds ? 'Funded' : 'Funding';
    }
}