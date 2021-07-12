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

class AbsenExport implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents, WithTitle
{
    use Exportable;
    
    public function __construct($data, $name, Request $request)
    {
        $this->data = $data;        
        $this->request = $request;        
        $this->name = $name;
    }

    public function registerEvents(): array
    {
        //$column = General::column_excel(intval($this->num_column) + 5);
        $start = 4;
        $maks = intval($start) + (count($this->data));

        return [
            AfterSheet::class => function(AfterSheet $event) use($maks, $start) {
                $event->sheet->styleCells(
                    'A'.$start.':E'.$maks,
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

        return view('exports.absen', compact('data'));
    }



    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 15,
            'C' => 30,
            'E' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            '4'    => ['font' => ['bold' => true]],
        ];
    }

    public function title(): string
    {
        return $this->name;
    }
}
