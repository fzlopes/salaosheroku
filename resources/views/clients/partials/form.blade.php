<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">

        @if(!empty($client))
            {!! Form::model($client, ['url' => route('clientes.update', $client->id), 'method' => 'put']) !!}
            {!! Form::hidden('id', $client->id) !!}
        @else
            {!! Form::open(['url' => route('clientes.store'), 'method' => 'post']) !!}
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
                                <a href="{{ route('clientes.index') }}" class="btn sbold default"> Voltar <i class="fa fa-rotate-left"></i></a>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="tab-content">
                                {!! Form::hidden('user_id', Auth::user()->id) !!}
                                <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                                    {!! Form::label('name', 'Nome *', ['class' => 'control-label']) !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'tabindex' => 1]) !!}
                                </div>

                                <div class="form-group {{ $errors->has('address') ? 'has-error' :'' }}">
                                    {!! Form::label('address', 'Endereço ', ['class' => 'control-label']) !!}
                                    {!! Form::text('address', null, ['class' => 'form-control', 'tabindex' => 2]) !!}
                                </div>

                                <div class="form-group {{ $errors->has('phone') ? 'has-error' :'' }}">
                                    {!! Form::label('phone', 'Telefone', ['class' => 'control-label']) !!}
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'tabindex' => 3]) !!}
                                </div>

                                <div class="form-group {{ $errors->has('celphone') ? 'has-error' :'' }}">
                                    {!! Form::label('celphone', 'Celular', ['class' => 'control-label']) !!}
                                    {!! Form::text('celphone', null, ['class' => 'form-control', 'tabindex' => 4]) !!}
                                </div>

                                <div class="form-group {{ $errors->has('whats') ? 'has-error' :'' }} whats">
                                                {!! Form::label('whats', 'Whats', ['class' => 'control-label']) !!}
                                                <br>
                                                @if(!empty($client) && ($client->whats == 1))
                                                    {!! Form::checkbox('whats', 1 ,true ,  ['class' => '','tabindex' => 5]) !!}
                                                @else
                                                    {!! Form::checkbox('whats', 1 ,false , ['class' => '','tabindex' => 5]) !!}
                                                @endif
                                            </div>
                             
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <div class="tab-content">
                                <div class="form-actions">
                                    <div class="margiv-top-10">
                                        {!! Form::submit('Enviar', ['class' => 'btn green', 'tabindex' => 6]) !!}
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