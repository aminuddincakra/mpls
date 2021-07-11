<?php

namespace App\Exports;

use App\User;
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

class ActivityMultipleExport implements WithMultipleSheets
{
    use Exportable;
    
    public function __construct($data, $column, $last_col, Request $request)
    {
        $this->data = $data;        
        $this->request = $request;
        $this->column = $column;
        $this->last_col = $last_col;
    }

    public function sheets(): array
    {
        $sheets = [];
        $dta = [];        
        $data = $this->data;
        $request = $this->request;
        $column = $this->column;
        $last_col = $this->last_col;

        foreach($data as $dt){
            $dta[$dt['kelas']][] = $dt;
        }

        foreach($dta as $key => $dx){            
            $sheets[] = new ActivityExport($dx, $column, $key, $last_col, $request);
        }

        return $sheets;
    }    
}
