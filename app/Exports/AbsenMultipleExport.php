<?php

namespace App\Exports;

use App\User;
use App\Models\Classes;
use App\Helpers\General;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ClockInOutStudentMultipleAttendanceExport implements WithMultipleSheets
{
    use Exportable;
    
    public function __construct($data, $period, $centre, $num_column, Request $request)
    {
        $this->data = $data;
        $this->period = $period;
        $this->centre = $centre;
        $this->request = $request;
        $this->num_column = $num_column;
    }

    public function sheets(): array
    {
        $sheets = [];
        $dta = [];        
        $data = $this->data;
        $period = $this->period;
        $centre = $this->centre;
        $request = $this->request;
        $num_column = $this->num_column;        

        foreach($data as $dt){            
            $dta[$dt['classes']][] = $dt;
        }

        ksort($dta);

        foreach($dta as $key => $dx){            
            $sheets[] = new ClockInOutPerStudentAttendanceExport($dx, $period, $centre, $num_column, $key, $request);
        }

        return $sheets;
    }    
}
