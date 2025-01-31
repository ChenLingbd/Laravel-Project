<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reportable extends Model
{
    protected $fillable = ['report_id', 'reportable_id', 'reportable_type', 'user_id', 'description'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function reportable()
    {
        return $this->morphTo();
    }

    public function whistleblower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
