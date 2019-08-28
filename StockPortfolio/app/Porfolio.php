<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Porfolio extends Model
{
    // Table Name
    protected $table = 'Porfolio';
    // Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
}
