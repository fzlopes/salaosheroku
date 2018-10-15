@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/pages/css/profile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/global/plugins/chosen/chosen.css') }}" rel="stylesheet" type="text/css" />
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
                <a href="{{ route('agendas.index') }}">Agenda</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Criar</span>
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

    <h1 class="page-title"> Criar agendamento </h1>

@endsection


@section('content')

    @include('layouts.partials.errors')

    @include('schedules.partials.form')

@endsection

@section('scripts')
    <script src="{{ asset('vendor/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery.input-ip-address-control-1.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pages/scripts/form-input-mask.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/localization/messages_pt_BR.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery.maskedinput.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/chosen/chosen.jquery.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $(".cliente").chosen({
                placeholder_text_single: "Selecione o cliente...",
                no_results_text: "Nenhum resultado para a pesquisa!"
                
            });

             $(".servico").chosen({
                placeholder_text_single: "Selecione o serviço...",
                no_results_text: "Nenhum resultado para a pesquisa!"
                
            });

            $('#value').inputmask('decimal', {
                'alias': 'numeric',
                //'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                //'prefix': 'R$ ',
                'placeholder': ''
            });
           
        });
    </script>
@endsection

