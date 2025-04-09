<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class EmployeeAttendance extends Model
{
    use HasFactory;
    use SoftDeletes;
    // Tinanggal ang status mula sa fillable
    protected $fillable = ['staff_id', 'date', 'in', 'out'];
    // Pag-cast ng in_time at out_time sa Carbon instance (using 'datetime' instead of 'timestamp')
    protected $casts = [
        'in' => 'timestamp',  // Automatically cast 'in' to a Carbon datetime instance
        'out' => 'timestamp', // Automatically cast 'out' to a Carbon datetime instance
    ];
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    // Awtomatikong itakda ang in_time at out_time kapag walang laman
    public static function boot()
    {
        parent::boot();
        static::saving(function ($attendance) {
            // Awtomatikong itakda ang in_time kung wala pa ito
            if (!$attendance->in) {
                $attendance->in = now(); // Set current date and time (timestamp)
            }
            // Awtomatikong itakda ang out_time kung wala pa ito
            if (!$attendance->out) {
                $attendance->out = now(); // Set current date and time (timestamp)
            }
        });
    }
}
