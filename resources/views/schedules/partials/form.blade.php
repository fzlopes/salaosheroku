<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">

        @if(!empty($schedule))
            {!! Form::model($schedule, ['url' => route('agendas.update', $schedule->id), 'method' => 'put']) !!}
            {!! Form::hidden('id', $schedule->id) !!}
        @else
            {!! Form::open(['url' => route('agendas.store'), 'method' => 'post']) !!}
        @endif

        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Dados básicos</span>
                            </div>
                            <div class="btn-group pull-right">
                                <a href="{{ route('agendas.index') }}" class="btn sbold default"> Voltar <i class="fa fa-rotate-left"></i></a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class=" form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                    {!! Form::label('date', 'Data *', ['class' => 'control-label']) !!}
                                    {!! Form::date('date', null , ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Data','tabindex' => 1]) !!}
                                </div>

                                <div class=" form-group {{ $errors->has('hour') ? 'has-error' :'' }}">
                                    {!! Form::label('hour', 'Hora *', ['class' => 'control-label']) !!}
                                    {!! Form::time('hour', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Hora', 'tabindex' => 2]) !!}
                                </div>

                                <div class=" form-group {{ $errors->has('client_id') ? 'has-error' :'' }}">
                                    {!! Form::label('client_id', 'Cliente *', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_id', $clients, !empty($schedule->client)?$schedule->client->id:null,  ['class' => 'form-control cliente','required' => 'required', 'data-placeholder' => 'Selecione o cliente...', 'tabindex' => 3]) !!}
                                </div>

                                <div class="form-group {{ $errors->has('service_id') ? 'has-error' :'' }}">
                                    {!! Form::label('service_id', 'Serviço *', ['class' => 'control-label']) !!}
                                    {!! Form::select('service_id', $services, !empty($schedule->service)?$schedule->service->id:null,  ['class' => 'form-control servico', 'required' => 'required', 'data-placeholder' => 'Selecione o serviço...', 'tabindex' => 4]) !!}
                                </div>

                                <div class="form-group {{ $errors->has('observation') ? 'has-error' :'' }}">
                                    {!! Form::label('observation', 'Observação', ['class' => 'control-label']) !!}
                                    {!! Form::text('observation', null, ['class' => 'form-control', 'placeholder' => 'Observação', 'tabindex' => 5]) !!}
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class=" form-group {{ $errors->has('value') ? 'has-error' :'' }}">
                                            {!! Form::label('value', 'Valor', ['class' => 'control-label']) !!}
                                            <br>
                                            {!! Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'Valor pago', 'tabindex' => 6]) !!}
                                        </div>
                                    </div>
                                </div>
              
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="form-actions">
                                    <div class="margiv-top-10">
                                        {!! Form::submit('Enviar', ['class' => 'btn green', 'tabindex' => 7]) !!}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>