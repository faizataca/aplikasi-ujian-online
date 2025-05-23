<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringUjian extends Model
{
    use HasFactory;

    // Use the same connection as ExamSchedule
    protected $connection = 'data_db';
    
    // Reference the same table as ExamSchedule
    protected $table = 't_penjadwalan';
    
    // Use the same primary key
    protected $primaryKey = 'id_penjadwalan';
    
    // Disable timestamps since the original table doesn't use them
    public $timestamps = false;

    protected $fillable = [
        'id_paket_ujian',
        'tipe_ujian',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'kuota',
        'status',
        'jenis_ujian',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'kuota' => 'integer',
        'status' => 'integer',
        'jenis_ujian' => 'integer',
    ];
    
    // Accessor to map the field names to match what the UI expects
    public function getTipeUjianAttribute()
    {
        return $this->attributes['tipe_ujian'] ?? '';
    }
    
    public function getPaketUjianAttribute()
    {
        // Get the related paket info from id_paket_ujian if needed
        // For now just return the ID
        return $this->attributes['id_paket_ujian'] ?? '';
    }
    
    public function getKelasProdiAttribute()
    {
        // Return something for kelas_prodi field - could be populated from elsewhere
        // This is a placeholder - you would need to modify based on your actual data structure
        return $this->attributes['jenis_ujian'] ?? '';
    }
    
    public function getTanggalUjianAttribute()
    {
        return $this->tanggal;
    }
    
    public function getMulaiAttribute()
    {
        return $this->attributes['waktu_mulai'] ?? '';
    }
    
    public function getSelesaiAttribute()
    {
        return $this->attributes['waktu_selesai'] ?? '';
    }
    
    public function getTipeAttribute()
    {
        // Map status to Remidi or Regular based on your business logic
        // This is a placeholder - adjust according to your needs
        return ($this->attributes['status'] ?? 0) == 1 ? 'Regular' : 'Remidi';
    }
}