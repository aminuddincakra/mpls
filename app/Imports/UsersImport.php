<?php

namespace App\Imports;

use App\User;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {      
        if($row[0] != 'NO'){
          $jur = Jurusan::firstOrCreate(['name' => $row['4']]);                    
          if($row['0'] != '' AND $row['1'] != '' AND $row['2'] != '' AND $row['3'] != '' AND $row['4'] != '' AND $row['5'] != '' AND $row['6'] != ''){            
            /*return User::updateOrCreate(
                ['email' => trim($row['1'])],
                ['name' => trim($row['2']), 'password' => \Hash::make(trim($row['1'])), 'kelas' => trim($row['3']), 'jurusan_id' => $jur->id, 'perm_id' => 2, 'activate' => 1, 'wali_kelas' => trim($row['5']), 'link' => trim($row['6']), 'asal_sekolah' => trim($row['7'])]
            );*/

            User::where('email', trim($row['1']))->update(['asal_sekolah' => trim($row['7']), 'link' => trim($row['6']), 'wali_kelas' => trim($row['5'])]);
          }  
        }
    }
}