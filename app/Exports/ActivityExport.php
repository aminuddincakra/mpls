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

class ActivityExport implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents, WithTitle
{
    use Exportable;
    
    public function __construct($data, $column, $name, $last_col, Request $request)
    {
        $this->data = $data;        
        $this->request = $request; 
        $this->column = $column;        
        $this->name = $name;
        $this->last_col = $last_col;
    }

    public function registerEvents(): array
    {
        $column = $this->last_col;
        $start = 4;
        $maks = intval($start) + (count($this->data)) + 1;

        return [
            AfterSheet::class => function(AfterSheet $event) use($maks, $start, $column) {
                $event->sheet->styleCells(
                    'A'.$start.':'.$column.$maks,
                    [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000'],
                            ],
                        ]
                    ]
                );
            },
        ];
    }

    public function view(): View
    {        
        $data = $this->data;        
        $request = $this->request;  
        $column = $this->column;            

        return view('exports.activity', compact('data', 'column'));
    }



    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            '4'    => ['font' => ['bold' => true]],
            '5'    => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return $this->name;
    }
}
