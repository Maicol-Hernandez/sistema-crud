@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{ $error }}

        </li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $modo }} empleado</h1>
                </div>
                <div class="card-body row">

                    <div class="form-group mb-3 col-md-6  ">
                        <input class="form-control" type="text" placeholder="Nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre')  }}" name="nombre" id="nombre">
                    </div>


                    <div class="form-gruop mb-3  col-md-6">
                        <input class="form-control" type="text" placeholder="Primer apellido" value="{{ isset($empleado->primerApellido)?$empleado->primerApellido:old('primerApellido')  }}" name="primerApellido" id="primerApellido">
                    </div>


                    <div class="form-group mb-3  col-md-6">
                        <input class="form-control" type="text" placeholder="Segundo apellido" value="{{ isset($empleado->segundoApellido)?$empleado->segundoApellido:old('segundoApellido')  }}" name="segundoApellido" id="segundoApellido">
                    </div>


                    <div class="form-group mb-3 col-md-6">
                        <input class="form-control" type="email" placeholder="E-mail" value="{{ isset($empleado->email)?$empleado->email:old('email')  }}" name="email" id="email">
                    </div>


                    <div class="form-group mb-3">
                        <input class="form-control" type="file" placeholder="Foto" name="foto" id="foto">
                    </div>
                    <div class="col-md-3 mb-3  offset-md-9 text-md-end">
                        @if(isset($empleado->foto))
                        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto }}" width="100" alt="">
                        @endif

                    </div>


                    <!-- <div class="bg-primary col-md-4 " > -->
                    <div class="col-md-5 offset-md-7 ">
                        <div class="row ">
                            <div class="col ">
                                <button class="btn btn-success" type="submit" value="Guardar datos">{{ $modo }} datos</button>
                            </div>
                            <div class="col">
                                <a href="{{ url('empleado/') }}">
                                    <button class="btn btn-primary" type="button">
                                        Regresar
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>





                    <!-- </div> -->

                </div>
            </div>
        </div>

    </div>

</div>