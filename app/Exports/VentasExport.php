<?php

namespace App\Exports;

use App\Models\Venta;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection; //para trabajar con colecciones y obtener la data
use Maatwebsite\Excel\Concerns\WithHeadings; //para definir los titulos de encabezado
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; //para trabajar con las hojas de calculo
use Maatwebsite\Excel\Concerns\WithCustomStartCell; //para definir la celda donde inicia el reporte
use Maatwebsite\Excel\Concerns\WithTitle; //para colocar nombre a la hoja de calculo
use Maatwebsite\Excel\Concerns\WithStyles; //para dar formato a las celdas

class VentasExport implements
    FromCollection,
    WithHeadings,
    WithCustomStartCell,
    WithTitle,
    WithStyles
{
    protected $data = [];

    function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return $this->data;
    }

    //cabezeras de la hoja de calculo
    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Estado',
            'Usuario',
            'Cliente',
            'Items',
            'Total',
        ];
    }
    //definir la celda donde inicia el reporte
    public function startCell(): string
    {
        return 'A2';
    }
    //dar formato a las celdas
    public function styles(Worksheet $sheet)
    {
        return [
            // El 2 especifica la fila donde se aplica el bold
            2   => ['font' => ['bold' => true]],
            'A2:H2' => ['font' => ['bold' => true]],
        ];
    }

    //nombre de la hoja de calculo
    public function title(): string
    {
        return 'Reporte de Ventas';
    }
    public function endCell(): string
    {
        return 'H2';
    }

}
