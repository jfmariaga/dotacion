<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\EntregaEpp;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class SignaturePadController extends Controller
{
    public  $nameTemp;
    public function index($usuario)
    {
        $emple = Empleado::where('id', $usuario)->get();
        return view('signature-pad', compact('emple'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Empleado::find($id);
        $folderPath = public_path('signatures/'); // create signatures folder in public directory
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);

        $usuario->update([
            $usuario->firma = $file,

        ]);
        return redirect()->route('empleado', $usuario)->with('info', 'El registro de la firma fue exitoso!');
    }

    public function Addtopdf($id)
    {
        //por medio del ID que viene por GET buscamos la entrega
        $entrega = EntregaEpp::find($id);

        // nueva instancia de FPDI
        $pdf = new Fpdi();


        // agregamos una pagina
        $pdf->AddPage();

        // seleccionamos la fuente y el tamañ de la letra 
        $pdf->SetFont('helvetica', '', '9');

        //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
        $path = public_path("formato.pdf");

        // Se establece la ruta 
        $pdf->setSourceFile($path);


        // seleccionamos el numero de paginas que queremos 
        $tplId = $pdf->importPage(1);

        // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
        $pdf->useTemplate($tplId, null, null, null, 210, true);

        //empezamos a sobre escribir los datos en el PDF

        // primer valor eje X segundo valor eje Y SetXY(31, 42)
        $pdf->SetXY(31, 42);
        // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
        $pdf->Write(0.1, $entrega->empleado->nombre);

        $pdf->SetXY(80, 45);
        $pdf->Write(0.1, $entrega->empleado->cargo);

        $pdf->SetXY(35, 48);
        $pdf->Write(0.1, "Rionegro-Antioquia");

        $pdf->SetXY(105, 48);
        $pdf->Write(0.1, $entrega->fechaEntrega);


        $pdf->SetXY(18, 180);
        $pdf->Image($entrega->empleado->firma, 13, 160, 43, 22);


        // Descarga el PDF en ves de guardarlo en un carpeta si lo quieres guardar cambiar D por F en el primer valor
        // se guardara por defecto en la carpeta public
        $pdf->Output('D', 'ACTA' . $entrega->empleado->cc . '.pdf');
    }

    public function foso32($id)
    {

        //por medio del ID que viene por GET buscamos la entrega
        $trabajador = Empleado::find($id);
        $responsable = Empleado::find(308);

        $entrega = EntregaEpp::where('empleado_id', $id)->get();

        $array2023 = [];
        $array2024 = [];
        foreach ($entrega as $item) {
            if ($item->fechaEntrega < "2023-12-31") {
                array_push($array2023, $item);
            } else {
                array_push($array2024, $item);
            }
        }
        if ($array2023 != null) {

            // nueva instancia de FPDI
            $pdf = new Fpdi();

            // agregamos una pagina
            $pdf->AddPage();

            // seleccionamos la fuente y el tamañ de la letra
            $pdf->SetFont('helvetica', '', '6');

            //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
            $path = public_path("formato_m.pdf");
            // if ($trabajador->tp_contrato == 'Manpower') {
            //     $path = public_path("fs32_M.pdf");
            // } else if ($trabajador->tp_contrato == 'Ahora') {
            //     $path = public_path("fs32_A.pdf");
            // } else {
            //     $path = public_path("fs32.pdf");
            // }

            // Se establece la ruta
            $pdf->setSourceFile($path);

            // seleccionamos el numero de paginas que queremos
            $tplId = $pdf->importPage(1);

            // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
            $pdf->useTemplate($tplId, null, null, null, 210, true);

            //empezamos a sobre escribir los datos en el PDF

            // primer valor eje X segundo valor eje Y SetXY(31, 42)
            $pdf->SetXY(41, 38);
            // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
            $pdf->Write(0.1, $trabajador->nombre);

            $pdf->SetXY(15, 127.2);
            // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
            $pdf->Write(0.1, $trabajador->nombre);

            $pdf->SetXY(102, 38);
            $pdf->Write(0.1, $trabajador->area);

            $pdf->SetXY(21, 41.4);
            $pdf->Write(0.1, $trabajador->cc);

            $pdf->SetXY(102, 41.4);
            $pdf->Write(0.1, $trabajador->centro);

            // $pdf->SetXY(89, 42.5);
            // $pdf->Write(0.1, $entrega[0]['fechaEntrega']);

            $pdf->Image($trabajador->firma, 33, 147, 39, 12);

            $pdf->Image($responsable->firma, 102, 147, 39, 12);

            // $pdf->SetXY(100, 189);
            // $pdf->Write(0.1, $trabajador->cc);


            $x = 29;
            $y = 62;
            $j = 15;
            $r = 60.3;
            $m = 80;
            $f = 91;

            foreach ($array2023 as $item) {
                for ($i = 0; $i < 4; $i++) {
                    $y += 1;
                    $r += 1;
                }

                if ($y > 150) {

                    $y = 66;
                    $r = 64.3;

                    $pdf->AddPage();

                    // seleccionamos la fuente y el tamañ de la letra
                    $pdf->SetFont('helvetica', '', '6');

                    //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
                    $path = public_path("formato_m.pdf");

                    // Se establece la ruta
                    $pdf->setSourceFile($path);

                    // seleccionamos el numero de paginas que queremos
                    $tplId = $pdf->importPage(1);

                    // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
                    $pdf->useTemplate($tplId, null, null, null, 210, true);

                    //empezamos a sobre escribir los datos en el PDF

                    // primer valor eje X segundo valor eje Y SetXY(31, 42)
                    $pdf->SetXY(41, 38);
                    // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                    $pdf->Write(0.1, $trabajador->nombre);

                    $pdf->SetXY(15, 127.2);
                    // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                    $pdf->Write(0.1, $trabajador->nombre);

                    $pdf->SetXY(102, 38);
                    $pdf->Write(0.1, $trabajador->area);

                    $pdf->SetXY(21, 41.4);
                    $pdf->Write(0.1, $trabajador->cc);

                    $pdf->SetXY(102, 41.4);
                    $pdf->Write(0.1, $trabajador->centro);

                    // $pdf->SetXY(89, 42.5);
                    // $pdf->Write(0.1, $entrega[0]['fechaEntrega']);

                    $pdf->Image($trabajador->firma, 33, 147, 39, 12);

                    $pdf->Image($responsable->firma, 102, 147, 39, 12);
                }

                $pdf->SetXY($x, $y);
                $pdf->Write(0.1, $item->epp->descripcion);
                $pdf->SetXY($j, $y);
                $pdf->Write(0.1, $item->epp->item);
                $pdf->SetXY($m, $y);
                $pdf->Write(0.1, $item->cantidad);
                $pdf->SetXY($f, $y);
                $pdf->Write(0.1, $item->fechaEntrega);
                $pdf->Image($item->firma, 112, $r, 25, 4);
            }

            if ($array2024 != null) {
                // nueva instancia de FPDI

                // agregamos una pagina
                $pdf->AddPage();

                // seleccionamos la fuente y el tamañ de la letra
                $pdf->SetFont('helvetica', '', '6');

                //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
                $path = public_path("formato_m.pdf");
                // if ($trabajador->tp_contrato == 'Manpower') {
                //     $path = public_path("fs32_M.pdf");
                // } else if ($trabajador->tp_contrato == 'Ahora') {
                //     $path = public_path("fs32_A.pdf");
                // } else {
                //     $path = public_path("fs32.pdf");
                // }

                // Se establece la ruta
                $pdf->setSourceFile($path);

                // seleccionamos el numero de paginas que queremos
                $tplId = $pdf->importPage(1);

                // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
                $pdf->useTemplate($tplId, null, null, null, 210, true);

                //empezamos a sobre escribir los datos en el PDF

                // primer valor eje X segundo valor eje Y SetXY(31, 42)
                $pdf->SetXY(41, 38);
                // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                $pdf->Write(0.1, $trabajador->nombre);

                $pdf->SetXY(15, 127.2);
                // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                $pdf->Write(0.1, $trabajador->nombre);

                $pdf->SetXY(102, 38);
                $pdf->Write(0.1, $trabajador->area);

                $pdf->SetXY(21, 41.4);
                $pdf->Write(0.1, $trabajador->cc);

                $pdf->SetXY(102, 41.4);
                $pdf->Write(0.1, $trabajador->centro);

                // $pdf->SetXY(89, 42.5);
                // $pdf->Write(0.1, $entrega[0]['fechaEntrega']);

                $pdf->Image($trabajador->firma, 33, 147, 39, 12);

                $pdf->Image($responsable->firma, 102, 147, 39, 12);

                // $pdf->SetXY(100, 189);
                // $pdf->Write(0.1, $trabajador->cc);


                $x = 29;
                $y = 62;
                $j = 15;
                $r = 60.3;
                $m = 80;
                $f = 91;

                foreach ($array2024 as $item) {
                    for ($i = 0; $i < 4; $i++) {
                        $y += 1;
                        $r += 1;
                    }

                    if ($y > 150) {

                        $y = 66;
                        $r = 64.3;

                        $pdf->AddPage();

                        // seleccionamos la fuente y el tamañ de la letra
                        $pdf->SetFont('helvetica', '', '6');

                        //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
                        $path = public_path("formato_m.pdf");

                        // Se establece la ruta
                        $pdf->setSourceFile($path);

                        // seleccionamos el numero de paginas que queremos
                        $tplId = $pdf->importPage(1);

                        // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
                        $pdf->useTemplate($tplId, null, null, null, 210, true);

                        //empezamos a sobre escribir los datos en el PDF

                        // primer valor eje X segundo valor eje Y SetXY(31, 42)
                        $pdf->SetXY(41, 38);
                        // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                        $pdf->Write(0.1, $trabajador->nombre);

                        $pdf->SetXY(15, 127.2);
                        // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                        $pdf->Write(0.1, $trabajador->nombre);

                        $pdf->SetXY(102, 38);
                        $pdf->Write(0.1, $trabajador->area);

                        $pdf->SetXY(21, 41.4);
                        $pdf->Write(0.1, $trabajador->cc);

                        $pdf->SetXY(102, 41.4);
                        $pdf->Write(0.1, $trabajador->centro);

                        // $pdf->SetXY(89, 42.5);
                        // $pdf->Write(0.1, $entrega[0]['fechaEntrega']);

                        $pdf->Image($trabajador->firma, 33, 147, 39, 12);

                        $pdf->Image($responsable->firma, 102, 147, 39, 12);
                    }

                    $pdf->SetXY($x, $y);
                    $pdf->Write(0.1, $item->epp->descripcion);
                    $pdf->SetXY($j, $y);
                    $pdf->Write(0.1, $item->epp->item);
                    $pdf->SetXY($m, $y);
                    $pdf->Write(0.1, $item->cantidad);
                    $pdf->SetXY($f, $y);
                    $pdf->Write(0.1, $item->fechaEntrega);
                    $pdf->Image($item->firma, 112, $r, 25, 4);
                }
            }
            // Descarga el PDF en ves de guardarlo en un carpeta si lo quieres guardar cambiar D por F en el primer valor
            // se guardara por defecto en la carpeta public
            $pdf->Output('D', 'FO-GH-74-' . $trabajador->cc . '.pdf');
        }
    }

    public function fo74()
    {
        $responsable = Empleado::find(308);
        $entregas = EntregaEpp::all();

        foreach ($entregas as $entrega) {

            $pdf = new Fpdi();

            // agregamos una pagina
            $pdf->AddPage();

            // seleccionamos la fuente y el tamañ de la letra 
            $pdf->SetFont('helvetica', '', '6');

            //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
            $path = public_path("formato_m.pdf");

            // Se establece la ruta 
            $pdf->setSourceFile($path);

            // seleccionamos el numero de paginas que queremos 
            $tplId = $pdf->importPage(1);

            // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
            $pdf->useTemplate($tplId, null, null, null, 210, true);

            // empezamos a sobre escribir los datos en el PDF

            // primer valor eje X segundo valor eje Y SetXY(31, 42)
            $pdf->SetXY(41, 36);
            // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
            $pdf->Write(0.1, $entrega->empleado->nombre);

            $pdf->SetXY(15, 119.2);
            // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
            $pdf->Write(0.1, $entrega->empleado->nombre);

            $pdf->SetXY(102, 36);
            $pdf->Write(0.1, $entrega->empleado->area);

            $pdf->SetXY(21, 39);
            $pdf->Write(0.1, $entrega->empleado->cc);

            $pdf->SetXY(102, 39);
            $pdf->Write(0.1, $entrega->empleado->centro);

            $pdf->Image($entrega->empleado->firma, 33, 138, 39, 12);

            $pdf->Image($responsable->firma, 102, 138, 39, 12);


            $x = 29;
            $y = 56;
            $j = 15;
            $m = 95;

            foreach ($entregas as $item) {
                for ($i = 0; $i < 4; $i++) {
                    $y += 1;
                }
                $pdf->SetXY($x, $y);
                $pdf->Write(0.1, $item->epp->descripcion);
                $pdf->SetXY($j, $y);
                $pdf->Write(0.1, $item->epp->item);
                $pdf->SetXY($m, $y);
                $pdf->Write(0.1, $item->cantidad);

                if ($this->nameTemp != $item->empleado_id) {

                    $y = 56;
                    
                    $pdf->AddPage();
    
                    // seleccionamos la fuente y el tamañ de la letra 
                    $pdf->SetFont('helvetica', '', '6');
    
                    //  seleccionamos el pdf que se va a sobre escribir tiene que estar en la carpeta public
                    $path = public_path("formato_m.pdf");
    
                    // Se establece la ruta 
                    $pdf->setSourceFile($path);
    
                    // seleccionamos el numero de paginas que queremos 
                    $tplId = $pdf->importPage(1);
    
                    // use la página importada y colóquela en el punto 10,10 con un ancho de 100 mm
                    $pdf->useTemplate($tplId, null, null, null, 210, true);
    
                    //empezamos a sobre escribir los datos en el PDF
    
                    // primer valor eje X segundo valor eje Y SetXY(31, 42)
                    $pdf->SetXY(41, 36);
                    // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                    $pdf->Write(0.1, $entrega->empleado->nombre);
    
                    $pdf->SetXY(15, 119.2);
                    // siempre 0.1 y despues de la coma lo que queremos plasmar en el PDF
                    $pdf->Write(0.1, $entrega->empleado->nombre);
    
                    $pdf->SetXY(102, 36);
                    $pdf->Write(0.1, $entrega->empleado->area);
    
                    $pdf->SetXY(21, 39);
                    $pdf->Write(0.1, $entrega->empleado->cc);
    
                    $pdf->SetXY(102, 39);
                    $pdf->Write(0.1, $entrega->empleado->centro);
    
                    $pdf->Image($entrega->empleado->firma, 33, 138, 39, 12);
    
                    $pdf->Image($responsable->firma, 102, 138, 39, 12);
                }
            }
            $pdf->SetXY(89, 42.5);
            $pdf->Write(0.1, $item->fechaEntrega);

 

            $this->nameTemp = $entrega->empleado_id;

            // Descarga el PDF en ves de guardarlo en un carpeta si lo quieres guardar cambiar D por F en el primer valor
            // se guardara por defecto en la carpeta public
            $pdf->Output('D', 'FO-GH-74-' . $entrega->empleado->cc . '.pdf');
        }
    }
}
