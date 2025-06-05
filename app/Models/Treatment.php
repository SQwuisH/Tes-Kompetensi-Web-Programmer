<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_address',
        'patient_email',
        'visit_type',
        'doctor_id',
        'treatment_type',
        'medication',
        'cost',
        'status',
    ];

    public function Doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function Medication()
    {
        return $this->belongsTo(Medication::class, 'Medication');
    }
    public function TreatmentType()
    {
        return $this->belongsTo(TreatmentType::class, 'treatment_type');
    }
    public function VisitType()
    {
        return $this->belongsTo(VisitType::class, 'visit_type');
    }
}
