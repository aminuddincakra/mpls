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

class AbsenMultipleExport implements WithMultipleSheets
{
    use Exportable;
    
    public function __construct($data, Request $request)
    {
        $this->data = $data;        
        $this->request = $request;        
    }

    public function sheets(): array
    {
        $sheets = [];
        $dta = [];        
        $data = $this->data;
        $request = $this->request;

        foreach($data as $key => $dx){            
            $sheets[] = new AbsenExport($dx, $key, $request);
        }

        return $sheets;
    }    
}
