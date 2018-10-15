@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendor/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
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
                <span>Serviços</span>
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

    <h1 class="page-title"> Serviços
        <small>lista de todos os serviços cadastrados no sistema</small>
    </h1>

@endsection


@section('content')

    <div class="alert hide" id="alert-messages"></div>

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissable" id="alertSucesso">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <strong>Maravilha!</strong> {{ Session::get('success') }}
        </div>
    @endif

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group pull-right">
                                    <a href="{{ route('servicos.create') }}">
                                        <button id="sample_editable_1_new" class="btn sbold green"> Criar serviço
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th> Id       </th>
                                <th> Nome     </th>
                                <th> Actions  </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($services as $service)

                            <tr class="odd gradeX">
                                <td> {{$service->id}} </td>
                                <td> {{$service->name}} </td>
                                <td>
                                    <div class="clearfix">
                                        <a href="{{ route('servicos.show', $service->id) }}"><button class="btn grey-cascade btn-outline btn-xs mt-sweetalert" type="button"> ver </button></a>
                                        <a href="{{ route('servicos.edit', $service->id) }}"><button class="btn blue-hoki btn-outline btn-xs mt-sweetalert" type="button"> editar </button></a>
                                        <button class="btn red-sunglo btn-xs mt-sweetalert" type="button" data-button="del" data-id="{{ $service->id }}" data-title="Confirma exclusão do serviço {{ $service->name }}?" data-type="error" data-allow-outside-click="true" data-show-confirm-button="true" data-show-cancel-button="true" data-cancel-button-class="btn-default" data-cancel-button-text="Não" data-confirm-button-text="Sim, confirmo!" data-confirm-button-class="btn-danger"> apagar </button>
                                    </div>
                                    {!! Form::open(['url' => '', 'method' => 'deleter', 'id' => 'formBlockAndDelete']) !!} {!! Form::close() !!}
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var agree_action = function (sa_button, sa_id) {
            if (sa_button == 'del') {

                $.ajax({
                    type:"DELETE",
                    url:'servicos/'+sa_id,
                    data:$('#formBlockAndDelete').serialize(),
                    dataType: 'json',
                    success: function(data){
                        location.reload(false);
                    },
                    error : function(data){
                        location.reload(false);
                    }
                });

            }
            $('button').focus(function() {
                this.blur();
            });
        }
        var not_agree_action = function () {
            $('button').focus(function() {
                this.blur();
            });
        }
    </script>
    <script src="{{ asset('vendor/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pages/scripts/ui-sweetalert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>

@endsection
