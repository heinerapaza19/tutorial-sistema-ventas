@extends('layouts/app')
<style>
    .contenedor {
        background: gray;
        padding: 15px;
        display: flex;
        justify-content: space-around;
        gap: 20px;
        align-items: center;
        border-radius: 10px;
    }

    .img {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        object-fit: cover;
        background-color: gray;
        /* Fondo gris para la imagen */
    }

    @media screen and (max-width: 600px) {
        .contenedor {
            flex-direction: column;
            justify-content: center;
            flex-wrap: wrap;
            align-items: center;
        }
    }
</style>
@section('titulo', 'empresa')
@section('content')


{{-- notificaciones --}}

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

<h4 class="text-center text-secondary">DATOS DE LA EMPRESA</h4>



<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)

    <div class="contenedor">
        <div>
            @if($item->foto!= null)
            <img class="img" src="{{ asset('storage/empresa/' . $item->foto) }}" alt="">
            @else
            <img class="img" src="{{ asset('images/images.jpg')}}" alt="">
            @endif
        </div>

        <div>
            <h6><b>MODIFICAR IMAGEN</b></h6>
            <form action="{{route('empresa.actualizarLogo')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="alert alert-secondary"> Selecciona una imagen ligera y en formato válido (JPG, PNG, JPEG). </div>

                <div>
                    <input type="file" class="input form-control-file mb-3" name="foto" accept=".jpg, .png, .jpeg">

                    @error('foto')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-rounded">MODIFICAR FOTO</button>
                    <button type="submit" form="eliminarFoto" class="btn btn-danger btn-rounded">ELIMINAR FOTO</button>
                </div>
            </form>

            <form action="{{ route('empresa.eliminarLogo') }}" id="eliminarFoto" class="formulario-eliminar" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>


    <form action="{{ route('empresa.update', $item->id_empresa) }}" method="POST">
        @csrf
        <div class="row">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre"
                    value="{{ $item->nombre }}">

            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="telefono" class="input input__text" id="telefono" placeholder="telefono"
                    value="{{ $item->telefono }}">
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="ubicacion" class="input input__text" placeholder="ubicacion *"
                    value="{{ old('ubicacion', $item->ubicacion) }}">

            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="ruc" class="input input__text" placeholder="ruc *"
                    value="{{ old('ruc', $item->ruc) }}">

            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="correo" class="input input__text" placeholder="correo *"
                    value="{{ old('correo', $item->correo) }}">

            </div>

            <div class="text-right mt-0">
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>

    </form>
    @endforeach
</div>

@endsection