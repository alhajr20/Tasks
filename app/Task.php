<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tasks';
    protected $fillable = ['name','status_id', 'image', 'user_id','created_at', 'updated_at'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function groups() {
        return $this->belongsToMany(Group::class);
    }
}