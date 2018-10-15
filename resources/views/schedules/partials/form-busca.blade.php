<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">

        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Buscar Agenda</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ route('agendas.index') }}" class="btn sbold default"> Voltar <i class="fa fa-rotate-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="portlet-body form">

                {!! Form::open(['url' => route('agendas.buscar'), 'class' =>'', 'id' =>'submit_form', 'method' => 'post']) !!}
                <div class="form-wizard">
                    <div class="form-body">
                        <div class="tab-content">
                            <div class="alert alert-danger display-none">
                                <button class="close" data-dismiss="alert"></button> Você precisa preencher os campos abaixo. </div>
                            <div class="alert alert-success display-none">
                                <button class="close" data-dismiss="alert"></button> Validação correta </div>
                            <div class="tab-pane active" id="tab1">
                                <div class="container-fluid">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <div class=" form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                                {!! Form::label('date', 'Data*', ['class' => 'control-label']) !!}
                                                <br>
                                                {!! Form::date('date', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Data', 'tabindex' => 1]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="form-actions">
                                    <div class="margiv-top-10">
                                        {!! Form::submit('Buscar', ['class' => 'btn green', 'tabindex' => 2]) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->