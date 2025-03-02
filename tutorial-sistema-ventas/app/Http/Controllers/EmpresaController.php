<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function index()
    {
        try {
            $sql = DB::select('select * from empresa');
        } catch (\Throwable $th) {
            //throw $th;
        }
        return view('vistas/empresa/empresa', compact("sql"));
    }
    public function update(Request $request,$id)
    {
        try {
            $sql = DB::update('update empresa set nombre=?, telefono=?, ubicacion=?, ruc=?, correo=? where id_empresa=?', [
                $request->nombre,
                $request->telefono,
                $request->ubicacion,
                $request->ruc,
                $request->correo,
                $id
            
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == 1) {
            return back()->with('CORRECTO', 'Datos modificados correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al modificar');
        }
        
    }
    
    public function actualizarLogo(Request $request){
        
        $request->validate([
            "foto" => "required|image|mimes:jpeg,png,jpg",
        ]);
        
        // Obtener el archivo
        $file = $request->file("foto");
        
        // Nombre del archivo
        $nombreArchivo = "logo." . strtolower($file->getClientOriginalExtension());
        
        // Ruta de almacenamiento
        $ruta = storage_path("app/public/empresa");
        
        // Verificar si hay una imagen anterior
        $verificarLogo = DB::select("SELECT foto FROM empresa");
        $verificarLogo = $verificarLogo[0]->foto ?? null;
        
        if ($verificarLogo) {
            $rutaAnterior = storage_path("app/public/empresa/" . $verificarLogo);
            try {
                unlink($rutaAnterior);
            } catch (\Throwable $th) {
                // Error al eliminar el archivo, continuar de todos modos
            }
        }
        
        // Mover el archivo a la carpeta de almacenamiento
        $res = $file->move($ruta, $nombreArchivo);
        
        // Actualizar la base de datos
        try {
            $actualizarCampo = DB::update("UPDATE empresa SET foto=?", [$nombreArchivo]);
            if ($actualizarCampo == 0) {
                $actualizarCampo = 1;
            }
        } catch (\Throwable $th) {
            $actualizarCampo = 0;
        }
        
        if ($res && $actualizarCampo) {
            return back()->with('CORRECTO', 'Logo actualizado correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al actualizar el logo');
        }
        
        
    }

    //para eliminar
    public function eliminarLogo(){
        $consulta=DB::select("SELECT foto FROM empresa");
        $nombreLogo=$consulta[0]->foto;
        $ruta=\public_path('storage/empresa/'.$nombreLogo);

        try {
            $eliminar=unlink($ruta);
            $actualizarCampo=DB::update("UPDATE empresa SET foto= '' ");
        } catch (\Throwable $th) {
           
            $eliminar=false;
            $actualizarCampo=false;
        } 
        if ($eliminar && $actualizarCampo) {
            return back()->with('CORRECTO', 'Logo eliminado correctamente');
        } else {
            return back()->with('INCORRECTO', 'Error al eliminar el logo');
        }
        
    }
    
}
