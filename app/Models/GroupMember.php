<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_members';
    protected $fillable = ['user_id', 'group_id', 'created_at'];

    public $timestamps = false;

    use HasFactory;
}