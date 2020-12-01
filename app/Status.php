<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function task() {
        return $this->hasOne(Task::class);
    }
}
