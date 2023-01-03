<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'company_id'
    ];
    protected $hidden = [
        'password',
    ];
    public function setPasswordAttribute($value){

        $this->attributes['password'] = Hash::make($value);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
