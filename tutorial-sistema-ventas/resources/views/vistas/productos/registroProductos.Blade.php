@extends('layouts/app')
@section('titulo', 'Registro de Productos')

<style>
    textarea {
        field-sizing: content;
    }
    .mensaje {
        color: red;
        font-size: 14px;
        padding: 5px;
    }
</style>

@section('content')

{{-- Notificaciones --}}
@if (session('CORRECTO'))
<script>
    $(function notificacion() {
        new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "{{ session('CORRECTO') }}",
            styling: "bootstrap3"
        });
    });
</script>
@endif

@if (session('INCORRECTO'))
<script>
    $(function notificacion() {
        new PNotify({
            title: "INCORRECTO",
            type: "error",
            text: "{{ session('INCORRECTO') }}",
            styling: "bootstrap3"
        });
    });
</script>
@endif

<h4 class="text-center text-secondary">REGISTRO DE PRODUCTO</h4>
<form action="{{ route('productos.store') }}" method="POST">

    @csrf

    <div class="row col-12">
        <div class="fl-flex-label col-12 col-md-6 mb-3 px-2">
            <select name="txtcategoria" class="input input__select">
                <option value="">Seleccionar categoría...</option>
                @foreach ($categoria as $item)
                    <option value="{{ $item->id_categoria }}">{{ $item->nombre }}</option>
                @endforeach 
            </select>
            @error('txtcategoria')
                <small class="mensaje">{{ $message }}</small>
            @enderror
        </div>

        <div class="fl-flex-label col-12 col-md-6 mb-3 px-2">
            <input type="text" class="input input__text" placeholder="Código del Producto" name="txtcodigoproducto">
            @error('txtcodigoproducto')
                <small class="mensaje">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="row col-12">
        <div class="fl-flex-label col-12 col-md-6 mb-3 px-2">
            <input type="text" class="input input__text" placeholder="Nombre del Producto" name="txtnombreproducto">
            @error('txtnombreproducto')
                <small class="mensaje">{{ $message }}</small>
            @enderror
        </div>
        <div class="fl-flex-label col-12 col-md-6 mb-3 px-2">
            <input type="number" class="input input__text" placeholder="Precio del Producto" name="txtprecioproducto" step="0.05">
            @error('txtprecioproducto')
                <small class="mensaje">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="row col-12">
        <div class="fl-flex-label col-12 col-md-6 mb-3 px-2">
            <input type="number" class="input input__text" placeholder="Stock del Producto" name="txtstock">
            @error('txtstock')
                <small class="mensaje">{{ $message }}</small>
            @enderror
        </div>
        <div class="fl-flex-label col-12 col-md-6 mb-3 px-2">
            <textarea name="txtdescripcion" cols="38" rows="5" placeholder="Descripción" class="input input__text"></textarea>
            @error('txtdescripcion')
                <small class="mensaje">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="text-right mt-4 px-4">
        <button type="submit" class="btn btn-primary">GUARDAR</button>
    </div>

</form>

@endsection
