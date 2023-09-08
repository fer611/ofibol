<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrigenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            'BOLIVIA', 'ESTADOS UNIDOS', 'CHINA', 'AFGANISTAN', 'ALBANIA',
            'ALEMANIA', 'ALGERIA', 'ANDORRA', 'ANGOLA', 'ARGENTINA',
            'ARMENIA', 'ARUBA', 'AUSTRALIA', 'AUSTRIA', 'BAHAMAS',
            'BANGLADESH', 'BARBADOS', 'BELGICA', 'BELICE', 'BERMUDA',
            'BOSNIA-HERZEGOWINA', 'BRASIL', 'BULGARIA', 'CABO VERDE',
            'CANADA', 'CHILE', 'CHIPRE', 'COLOMBIA', 'COREA', 'COSTA-RICA',
            'CROACIA', 'CUBA', 'CURACAO', 'DINAMARCA', 'ECUADOR', 'EGIPTO',
            'EL SALVADOR', 'EMIRATOS ARABES UNIDOS', 'ESLOVAQUIA', 'ESLOVENIA',
            'ESPAÑA', 'FILIPINAS', 'FINLANDIA', 'FRANCIA', 'GHANA', 'GIBRALTAR',
            'GRECIA', 'GUATEMALA', 'GUINEA', 'HAITI', 'HOLANDA', 'HONDURAS',
            'HONG KONG', 'HUNGRIA', 'INDIA', 'INDONESIA', 'INGLATERRA', 'IRAN',
            'IRAQ', 'IRLANDA', 'ISLA DE MAN', 'ISLANDIA', 'ISLAS CAIMAN',
            'ISRAEL', 'ITALIA', 'JAMAICA', 'JAPON', 'JORDAN', 'KUWAIT',
            'LETONIA', 'LIBANO', 'LIBERIA', 'LITUANIA', 'MACAU', 'MADAGASCAR',
            'MALAYSIA', 'MALTA', 'MEXICO', 'MOLDAVIA', 'MULTIPAIS', 'NICARAGUA',
            'NIGERIA', 'NORUEGA', 'PAÍSES BAJOS', 'PAKISTAN', 'PALESTINA',
            'PANAMA', 'PARAGUAY', 'PERU', 'POLONIA', 'PORTUGAL', 'PUERTO-RICO',
            'QATAR', 'REINO UNIDO', 'REPUBLICA CHECA', 'República de Malta',
            'REPUBLICA-DOMINICANA', 'RUMANIA', 'RUSIA', 'SINGAPUR', 'SUD-AFRICA',
            'SUECIA', 'SUIZA', 'TAILANDIA', 'TAIWAN', 'TOGO', 'TURQUIA',
            'UCRANIA', 'URUGUAY', 'VATICANO', 'VENEZUELA', 'VIETNAM'
        ];

        $data = [];
        foreach ($paises as $pais) {
            $data[] = [
                'nombre' => $pais,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        DB::table('origenes')->insert($data);
    }
}
