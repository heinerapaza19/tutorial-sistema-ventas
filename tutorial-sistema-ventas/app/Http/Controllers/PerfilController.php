<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Contracts\Service\Attribute\Required;

class PerfilController extends Controller
{
    // creando una funcion
    public function index()
    {
        $idUsuario = Auth::user()->id_usuario;
        $datos = DB::select("SELECT * FROM usuario WHERE id_usuario=$idUsuario");
        return view("vistas.perfil", compact("datos"));
    }

    public function actualizarIMG(Request $request)
    {
        $request->validate([
            "foto" => "required|image|mimes:jpeg,png,jpg,"
        ]);

        $file = $request->file("foto");
        $idUsuario = Auth::user()->id_usuario;
        $nombreAechivo = $idUsuario . "." . strtolower($file->getClientOriginalExtension());
        $ruta = storage_path("app/public/fotos-perfil-usuario/" . $nombreAechivo);

        //verificar la imagen y hay uno lo elimina
        /*$verificarFoto=DB::select("SELECT foto FROM usuario WHERE id_usuario=$idUsuario");
        $verificarFoto = $verificarFoto[0]->foto;
        $nombreFotoAnterior=$verificarFoto;

        if($verificarFoto = !null){
            $rutaFotoAnterior=storage_path("app/public/fotos-perfil-usuario/$nombreFotoAnterior");
            try{
                unlink($rutaFotoAnterior);
            }catch (\Throwable $th){

            }
        }*/

        $res = move_uploaded_file($file, $ruta);
        //$actualizarFoto=DB::update("UPDATE usuario SET foto='$nombreAechivo' WHERE id_usuario=$idUsuario");

        //actulizando foto
        try{
            $actualizarFoto=DB::update("UPDATE usuario SET foto='$nombreAechivo' WHERE id_usuario=$idUsuario");
            if($actualizarFoto==0){
                $actualizarFoto=1;
            }
        }catch (\Throwable $th){
            $actualizarFoto = 0;

        }

        if ($res and $actualizarFoto) {
            return back()->with("mensaje", "Foto actualizada correctamente");
        } else {
            return back()->with("error", "Error, la foto ya existe");
        }
        
    }
    public function eliminarFotoPerfil()
    {
        
        $idUsuario=Auth::user()->id_usuario;
        $nombreFoto=Auth::user()->foto;
        $ruta=storage_path("app/public/fotos-perfil-usuario/$nombreFoto");
        try{
            $res = unlink($ruta);
            $actualizarCampoFoto=DB::update("UPDATE usuario SET foto='' WHERE id_usuario=$idUsuario");

        } catch(\Throwable $th){
            $res = false;
            $actualizarCampoFoto=false;

        }
        if($res and $actualizarCampoFoto){
            return back()->with("mensaje", "Imagen eliminada correctamente");
        }else{
            return back()->with("error", "Error al eliminar el imagen");
        }


    }
    public function actualizarDatos(Request $request){

      $request->validate([
        "nombre"=>"required",
        "apellido"=>"required",
        "correo"=>"required|email",
        "usuario"=>"required",
      ]);
        $idUsuario=Auth::user()->id_usuario;
        try{
            $modificar=DB::update("UPDATE usuario SET nombre=?, apellido
            =?, usuario=?, telefono=?, direccion=?, correo=? WHERE id_usuario=$idUsuario ",[
                $request->nombre,
                $request->apellido,
                $request->usuario,
                $request->telefono,
                $request->direccion,
                $request->correo,
    
               ]);
               $modificar=true;
        }
        catch(\Throwable $th){
            $modificar=false;
        }
        if($modificar){
            return back()->with("mensaje", "Datos actualizado correctamente");
        }else{
            return back()->with("error", "Error al modificar los datos");
        }
    }
}

