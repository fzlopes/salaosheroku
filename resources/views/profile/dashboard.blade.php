@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendor/pages/css/profile.css') }}" rel="stylesheet" type="text/css" />
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
                <span>Dashboard</span>
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

    <h1 class="page-title"> Dashboard
        <small>principais eventos e estatísticas</small>
    </h1>

@endsection


@section('content')

    <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$usuarios}}">0</span>
                    </div>
                    <div class="desc"> Usuários ativos </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                    <span data-counter="counterup" data-value="{{$clientes}}">0</span>
                    </div>
                    <div class="desc"> Clientes ativos</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$servicos}}"></span></div>
                    <div class="desc"> Total serviços  </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{$valor}}">0</span> R$ </div>
                    <div class="desc"> Total recebido </div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light bordered" style="padding-bottom: 101px;">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-red-sunglo hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Agendamentos</span>
                        <span class="caption-helper">por serviços</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <h4>Total de agendamentos adicionados no sistema, separados por serviços.</h4>
                    <div id="pie_chart_6" class="chart"></div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-red-sunglo hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Total Recebido em R$</span>
                        <span class="caption-helper">mês a mês</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <h4>Total recebido em R$ adicionado no sistema, separados por mês.</h4>
                    <div id="morris_chart_1"></div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    
    <div class="hide">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <div id="chart_1_1" class="chart"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@section('scripts')

    <script>
        
        var totalRecebidoMes;

        $(function(){
            $.ajax({
                type:"GET",
                url:'/totalRecebidoMes',
                dataType: 'json',
                async: false,
                success: function(response){
                    totalRecebidoMes = response;
                },
                error : function(response){
                    console.log(response);
                }
            });
        });

        var totalAgendamentosServico = [];

        $(function(){
            $.ajax({
                type:"GET",
                url:'agendamentosServico',
                dataType: 'json',
                async: false,
                success: function(response){
                    totalAgendamentosServico = [response.feminino, response.FemininoTintura, response.tinturaComTinta, response.tinturaSemTinta, response.masculinoMaquina, response.masculinoTesoura, response.pe, response.mao, response.maoPe, response.luzes, response.progressiva, response.escova, response.megaHair, response.chapinha];
                },
                error : function(response){
                    console.log(response);
                }
            });
        });

    </script>
    <script src="{{ asset('vendor/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/flot/jquery.flot.stack.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/flot/jquery.flot.crosshair.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('vendor/pages/scripts/dashboard.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/pages/scripts/charts-flotcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pages/scripts/charts-morris.js') }}" type="text/javascript"></script>
@endsection
