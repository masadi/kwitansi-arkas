<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_anggaran extends Model
{
    use HasFactory;
    public $incrementing = false;
	protected $table = 'tahun_anggaran';
	protected $primaryKey = 'tahun_anggaran_id';
	protected $guarded = [];
}
