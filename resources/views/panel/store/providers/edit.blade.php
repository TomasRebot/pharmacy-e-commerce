@extends('panel.layout.content-panel')
@section('page-name')
    Editar proveedor
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('providers.update', [$provider])}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control"
                                       value="{{$provider->name}}"
                                       name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="description">Descripcion <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="description" type="text" class="form-control"
                                       value="{{$provider->description}}"
                                       name="description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">

                                <div class="i-checks"><label> <input type="radio" value="1" name="state" @if(($provider->state)==1) checked="" @endif> <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" @if(($provider->state)==0) checked="" @endif > <i></i> Inactivo </label></div>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('providers.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
