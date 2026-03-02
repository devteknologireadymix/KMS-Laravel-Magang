<?php

namespace App\Models;
use App\Models\App;
use App\Models\User; 
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable =[
        'app_id',
        'user_id',
        'title',
        'body',
        'category',
        'thumbnail',
        'status',
        'published_at',
        'approved_by',
        'note_project',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
