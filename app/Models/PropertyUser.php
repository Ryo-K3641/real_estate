<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUser extends Model
{
    use HasFactory;

    protected $table = "property_user";
    protected $fillable = ['user_id', 'property_id'];
    public $timestamps = false;

    # To get the agent's name
    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
