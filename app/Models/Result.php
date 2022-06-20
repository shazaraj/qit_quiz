<?php

namespace App\Models;

use App\Exports\ResultsExport;
use Illuminate\Database\Eloquent\Model;
// use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;
    protected $table = "result";
    protected $fillable = [
        'user_id',
        'wrong_ans',
        'correct_ans',
        'result'
    ];

    protected $exportClass = ResultsExport::class;

    public function user(){
        return $this->hasOne('App\Models\User','user_id');
    }
}
