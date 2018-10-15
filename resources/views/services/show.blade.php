@extends('layouts.admin')

@section('css')

@endsection

@section('pagebar')

    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('profile.dashboard') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ route('servicos.index') }}">Serviços</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Visualizar</span>
            </li>
        </ul>
        <div class="page-toolbar">
            <div class="pull-right tooltips btn btn-sm">
                <i class="icon-calendar"></i>&nbsp;
                {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </div>
        </div>
    </div>
    <!-- END PAGE BAR -->

@endsection

@section('title')

    <h1 class="page-title"> Visualizar serviço </h1>

@endsection


@section('content')


    <div class="alert hide" id="alert-messages"></div>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form">
                        <div class="form-body">

                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('servicos.index') }}" class="btn sbold default"> Voltar <i class="fa fa-rotate-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="form-section">Informações</h3>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Nome:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static"> {{ $service->name }} </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                                    
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="{{ route('servicos.edit', $service->id) }}" class="btn green"> <i class="fa fa-pencil"></i> Editar </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>

                    </form>
                    <!-- END FORM-->

                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

@endsection

