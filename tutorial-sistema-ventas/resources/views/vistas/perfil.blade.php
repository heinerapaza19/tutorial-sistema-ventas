@extends('layouts.app')

@section('titulo', 'Mi perfil')

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
        background-color: gray; /* Fondo gris para la imagen */
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

@section('content')

  @if(session('mensaje'))
    <script>
        $(function notificacion(){
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "{{ session('mensaje') }}",
                styling: "bootstrap3"
                

            });
        });
    </script>
  @endif

  @if(session('error'))
    <script>
        $(function notificacion(){
            new PNotify({
                title: "INCORRECTO",
                type: "error",
                text: "{{ session('error') }}",
                styling: "bootstrap3"

            });
        });
    </script>
  @endif

  <h4 class="text-center text-secondary">MI PERFIL</h4>

  @foreach ($datos as $item)

   <div class="contenedor">
     <div>
        @if($item->foto !=null)
         <img class="img" src="{{ asset('storage/fotos-perfil-usuario/' . $item->foto) }}?t={{ time() }}" alt="Foto de perfil">
        @else
        <img class="img" src="{{ asset('images/img.jpg')}}" alt="">

        @endif
    </div>

    <div>
    <h6><b>MODIFICAR IMAGEN</b></h6>
        <form action="{{ route('perfil.actualizarIMG') }}" method="POST" enctype="multipart/form-data">
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

        <form action="{{ route('perfil.eliminarFotoPerfil')}}" id="eliminarFoto" class="formulario-eliminar" method="get">

        </form>
    </div>
   </div>

   <!-- Formulario de datos del usuario -->
   <form action="{{route('perfil.actulizarDatos')}}" method="POST" class="bg-white p-4">
      <div class="row">
          @method('put')

          @csrf

          <div class="fl-flex-label col-12 col-lg-6">
              <input type="text" class="input input__text m-4" placeholder="Nombres" value="{{ $item->nombre }}" name="nombre">
              @error('nombre')
                <small class="text-danger">{{$message}}</small>
              @enderror
          
            </div>

          <div class="fl-flex-label col-12 col-lg-6">
              <input type="text" class="input input__text m-4" placeholder="Apellido" value="{{ $item->apellido }}" name="apellido">
              @error('apellido')
                <small class="text-danger">{{$message}}</small>
              @enderror
          </div>
          <div class="fl-flex-label col-12 col-lg-6">
              <input type="text" class="input input__text m-4" placeholder="Usuario" value="{{ $item->usuario }}" name="usuario">
              @error('usuario')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>
          <div class="fl-flex-label col-12 col-lg-6">
              <input type="text" class="input input__text m-4" placeholder="Teléfono" value="{{ $item->telefono }}" name="telefono">
          </div>
          <div class="fl-flex-label col-12 col-lg-6">
              <input type="text" class="input input__text m-4" placeholder="Dirección" value="{{ $item->direccion }}" name="direccion">
          </div>
          <div class="fl-flex-label col-12 col-lg-6">
              <input type="email" class="input input__text m-4" placeholder="Correo" value="{{ $item->correo }}" name="correo">
              @error('correo')
                <small class="text-danger">{{$message}}</small>
              @enderror
            </div>

          <div class="text-right">
              <button type="submit" class="btn btn-primary btn-rounded">GUARDAR</button>
          </div>
      </div>
  </form>

 @endforeach

@endsection
