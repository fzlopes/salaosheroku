<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">

        @if(!empty($service))
            {!! Form::model($service, ['url' => route('servicos.update', $service->id), 'method' => 'put']) !!}
            {!! Form::hidden('id', $service->id) !!}
        @else
            {!! Form::open(['url' => route('servicos.store'), 'method' => 'post']) !!}
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
                                <a href="{{ route('servicos.index') }}" class="btn sbold default"> Voltar <i class="fa fa-rotate-left"></i></a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                                    {!! Form::label('name', 'Nome *', ['class' => 'control-label']) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'tabindex' => 1]) !!}
                                </div>
                            </div>
                               
                        </div>

                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="form-actions">
                                    <div class="margiv-top-10">
                                        {!! Form::submit('Enviar', ['class' => 'btn green', 'tabindex' => 2]) !!}
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