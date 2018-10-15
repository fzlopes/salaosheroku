@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendor/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/css/schedule.css') }}" rel="stylesheet" type="text/css" />
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
                <span>Agenda</span>
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

    <h1 class="page-title"> Agenda
        <small>lista de todos os clientes agendados do sistema</small>
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
                                <div class="btn-group pull-left">
                                    <a href="{{ route('agendas.create') }}">
                                        <button class="btn sbold btn-primary">Nova Agenda</button>
                                    </a>
                                    <a href="{{ route('agendas.busca') }}">
                                        <button class="btn sbold btn-primary">Busca Agenda</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 datahoje">
                                <div class="col-md-5">
                                    <a href="javascript:;" class="anterior" data-filter="prev">
                                        <i class="glyphicon glyphicon-backward prev-schedule"></i>
                                    </a>
                                    <h3 class="sbold schedule-date">{{$dataHoje}}</h3>
                                    <a href="javascript:;" class="proximo" data-filter="next">
                                        <i class="glyphicon glyphicon-forward next-schedule"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th> Hora       </th>
                            <th> Cliente    </th>
                            <th> Serviço    </th>
                            <th> Valor      </th>
                            <th>            </th>
                        </tr>
                        </thead>
                        <tbody class="mybody">
                        @if($schedules!=null)
                            @foreach ($schedules as $item)
                                  <tr class="odd gradeX">
                                        <td> {{$item->hour}} </td>
                                        <td> {{$item->client->name}} </td>
                                        <td> {{$item->service->name}} </td>
                                        <td> {{$item->value}} </td>
                                        <td>
                                            <div class="clearfix">
                                                <a href="{{ route('agendas.edit', $item->id) }}"><button class="btn grey" type="button"><i class="glyphicon glyphicon-pencil"></i></button></a>
                                                <button class="btn red mt-sweetalert" type="button" data-button="del" data-id="{{ $item->id }}" data-title="Confirma exclusão da consulta do cliente {{ $item->client->name }}?" data-type="error" data-allow-outside-click="true" data-show-confirm-button="true" data-show-cancel-button="true" data-cancel-button-class="btn-default" data-cancel-button-text="Não" data-confirm-button-text="Sim, confirmo!" data-confirm-button-class="btn-danger"> <i class="glyphicon glyphicon-remove"></i> </button>
                                            </div>
                                            {!! Form::open(['url' => '', 'method' => 'deleter', 'id' => 'formDelete']) !!} {!! Form::close() !!}
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                        @endif
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
                    url:'/agendas/'+sa_id,
                    data:$('#formDelete').serialize(),
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
    <script type="text/javascript">
        jQuery(document).ready(function() {

            $('.anterior').on('click', function() {

                var dataPt = $('.schedule-date').html();

                var data = new Date(dataPt.substr(6,4)+'-'+dataPt.substr(3,2)+'-'+dataPt.substr(0,2));

                var prevDate = data.getFullYear() + '-' + (data.getMonth()+1) + '-' + data.getDate();

                $('.schedule-date').html(data.toLocaleDateString("pt-BR"));

                $.ajax({
                    type:"GET",
                    url:'/agendas/search/'+prevDate,
                    dataType: 'json',
                    success: function(data){
                        var str = '';
                        data['schedules'].forEach(function(valor, chave){

                           str += '<tr><td>'+valor['hour']+'</td><td>';

                            if( valor['client_id'] != null) {
                                str += data['clients'][valor['client_id']];
                            }

                            str += '</td><td>';

                             if( valor['service_id'] != null) {
                                str += data['services'][valor['service_id']];
                            }

                            str += '</td><td>';

                            if( valor['value'] != null) {
                                str += valor['value'];
                            }

                            str += '</td><td>'


                            str += '<div class="clearfix"><a href="/agendas/'+valor['id']+'/edit"><button class="btn grey" type="button"><i class="glyphicon glyphicon-pencil"></i></button></a>';
                            str += '<form method="POST" action="/agendas/'+valor['id']+'" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="EpzHCLDT5hrvvktJRhBSc8gnxE1eoH7GP0kl612s">';
                            str += '<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button></form></div>';
                            str += '</td></tr>';

                        });
                        
                        $('.mybody').html(str);

                    },
                    error : function(data){
                        console.log(data);
                    }
                });

            });

            $('.proximo').on('click', function() {

                var dataPt = $('.schedule-date').html();

                var data = new Date(dataPt.substr(6,4)+'-'+dataPt.substr(3,2)+'-'+dataPt.substr(0,2));

                data.setDate(data.getDate()+2);

                var nextDate = data.getFullYear() + '-' + (data.getMonth()+1) + '-' + data.getDate();

                $('.schedule-date').html(data.toLocaleDateString("pt-BR"));

                $.ajax({
                    type:"GET",
                    url:'/agendas/search/'+nextDate,
                    dataType: 'json',
                    success: function(data){
                        var str = '';
                        data['schedules'].forEach(function(valor, chave){

                          str += '<tr><td>'+valor['hour']+'</td><td>';

                            if( valor['client_id'] != null) {
                                str += data['clients'][valor['client_id']];
                            }

                            str += '</td><td>';

                            if( valor['service_id'] != null) {
                                str += data['services'][valor['service_id']];
                            }

                            str += '</td><td>';

                            if( valor['value'] != null) {
                                str += valor['value'];
                            }

                            str += '</td><td>'


                            str += '<div class="clearfix"><a href="/agendas/'+valor['id']+'/edit"><button class="btn grey" type="button"><i class="glyphicon glyphicon-pencil"></i></button></a>';
                            str += '<form method="POST" action="/agendas/'+valor['id']+'" accept-charset="UTF-8" style="display:inline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="EpzHCLDT5hrvvktJRhBSc8gnxE1eoH7GP0kl612s">';
                            str += '<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button></form></div>';
                            str += '</td></tr>';

                        });
                        $('.mybody').html(str);

                    },
                    error : function(data){
                        console.log(data);
                    }
                });

            });

            var agree_action = function (sa_button, sa_id) {
                if (sa_button == 'del') {

                    $.ajax({
                        type:"DELETE",
                        url:'/agendas/'+sa_id,
                        data:$('#formDelete').serialize(),
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

        });
    </script>
@endsection

