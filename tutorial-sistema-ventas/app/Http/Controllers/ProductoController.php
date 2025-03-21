<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoria=DB::select("SELECT * FROM categoria");
        return view("vistas/productos/registroProductos")->with("categoria",$categoria);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación de campos
    $request->validate([
        'txtcategoria' => 'required',
        'txtcodigoproducto' => 'required',
        'txtnombreproducto' => 'required',
        'txtprecioproducto' => 'required|numeric',
        'txtstock' => 'required|numeric',
    ]);

    // Validación de código de producto duplicado
    $producto = DB::select("SELECT count(*) as total FROM producto WHERE codigo=?", [$request->txtcodigoproducto]);
    if ($producto[0]->total > 0) {
        return back()->with("INCORRECTO", "El código de producto ya existe");
    }
    $registro = DB::insert("INSERT INTO producto(id_categoria, codigo, nombre, precio, stock, descripcion, estado) 
    VALUES (?, ?, ?, ?, ?, ?, ?)", [
        $request->txtcategoria,        // 1️⃣ Categoría
        $request->txtcodigoproducto,   // 2️⃣ Código
        $request->txtnombreproducto,   // 3️⃣ Nombre
        $request->txtprecioproducto,   // 4️⃣ Precio
        $request->txtstock,            // 5️⃣ Stock
        $request->txtdescripcion,      // 6️⃣ Descripción (falta en tu código original)
        "1"                            // 7️⃣ Estado
    ]);

if ($registro) {
    return back()->with("CORRECTO", "Producto registrado correctamente");
} else {
    return back()->with("ERROR", "Error al registrar el producto");
}

    


}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
