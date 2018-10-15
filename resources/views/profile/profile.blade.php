@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
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
                <span>Profile</span>
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

    <h1 class="page-title"> Meu perfil
        <small>alterar dados pessoais, foto do perfil e redefinir senha</small>
    </h1>

@endsection


@section('content')

    <div class="alert hide" id="alert-messages"></div>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet bordered">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if (!$user->picture)
                            <img src="{{ asset('assets/pages/media/profile/guest_user.jpg') }}" class="img-responsive" alt="Sua foto" title="Escolha uma foto sua para colocar aqui">
                        @else
                            <img src="{{  asset('/uploads/users/img/' . $user->picture) }}" class="img-responsive" alt="{{ $user->name }}" />
                        @endif
                    </div>

                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        @if ($user->picture)
                            <form method="POST" action="{{ route('profile.remove-picture', Auth::user()->id) }}" accept-charset="UTF-8" id="formRemovePicture">
                                <input name="_method" type="hidden" value="PUT">
                                @csrf
                                <input class="btn btn-circle red btn-sm" type="submit" value="REMOVER IMAGEM">
                            </form>
                        @endif
                    </div>
                    <!-- END SIDEBAR BUTTONS -->


                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{ Auth::user()->name }} </div>
                        @foreach (Auth::user()->roles()->get() as $role)
                            <div class="profile-usertitle-job"> {{ $role->name }} </div>
                        @endforeach
                        {{--<div class="profile-usertitle-job"> {{ ->first()->name }} </div>--}}
                    </div>
                    <div class="profile-usermenu"></div>
                </div>
                <!-- END PORTLET MAIN -->

                <!-- PORTLET MAIN -->
                <div class="portlet light ">
                    <!-- STAT -->
                    <div class="row list-separated profile-stat">

                        <div class="col-md-12 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title"> {{ Auth::user()->roles()->count() }} </div>
                            <div class="uppercase profile-stat-text"> Grupo(s) </div>
                        </div>

                    </div>
                    <!-- END STAT -->
                </div>
                <!-- END PORTLET MAIN -->
            </div>


            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Meu perfil</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li id="tab1" class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Informações pessoais</a>
                                    </li>
                                    <li id="tab2">
                                        <a href="#tab_1_2" data-toggle="tab">Alterar imagem do perfil</a>
                                    </li>
                                    <li id="tab3">
                                        <a href="#tab_1_3" data-toggle="tab">Redefinir senha</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">

                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">

                                        <form method="POST" action="{{ route('profile.change-profile', Auth::user()->id) }}" accept-charset="UTF-8" id="formChangeProfile">
                                            <input name="_method" type="hidden" value="PUT">
                                            <input name="userId" type="hidden" value="{{ Auth::user()->id }}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name" class="control-label">Nome</label>
                                                <input class="form-control" required="required" name="name" type="text" value="{{ $user->name }}" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="control-label">E-mail</label>
                                                <input class="form-control" required="required" name="email" type="text" value="{{ $user->email }}" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="created_at" class="control-label">Criado em</label>
                                                <input class="form-control input-medium" disabled="disabled" name="created_at" type="text" value="{{ $user->created_at->format('d/m/Y H:i:s') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="updated_at" class="control-label">Última atualização</label>
                                                <input class="form-control input-medium" disabled="disabled" name="updated_at" type="text" value="{{ $user->updated_at->format('d/m/Y H:i:s') }}">
                                            </div>
                                            <div class="margiv-top-10">
                                                <input class="btn green" type="submit" value="Salvar alterações">
                                                <a href="{{ route('profile.dashboard') }}" class="btn default"> Cancelar </a>
                                            </div>

                                        </form>

                                    </div>
                                    <!-- END PERSONAL INFO TAB -->

                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <p> Escolha uma nova foto e mude a imagem de seu perfil. </p>

                                        <form method="POST" action="{{ route('profile.change-picture', Auth::user()->id) }}" accept-charset="UTF-8" id="formChangePicture" enctype="multipart/form-data">
                                            <input name="_method" type="hidden" value="PUT">
                                            @csrf

                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div>
                                                        <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Selecione a imagem </span>
                                                        <span class="fileinput-exists"> Alterar </span>
                                                        <input id="picture" name="picture" type="file">
                                                        </span>
                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                    </div>
                                                    <br>
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>

                                                </div>
                                            </div>
                                            <div class="margin-top-10">
                                                <input class="btn green" type="submit" value="Alterar imagem">
                                                <a href="#tab_1_1" data-toggle="tab" id="btnCancel1" class="btn default"> Cancelar </a>
                                            </div>

                                        </form>

                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->

                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">

                                        <form method="POST" action="{{ route('profile.change-password', Auth::user()->id) }}" accept-charset="UTF-8" id="formChangePassword">
                                            <input name="_method" type="hidden" value="PUT">
                                            @csrf

                                            <div class="form-wizard">
                                                <div class="form-group">
                                                    <label class="control-label">Senha atual</label>
                                                    <input type="password" name="current" class="form-control" required />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Nova senha</label>
                                                    <input type="password" class="form-control" id="password" name="password" id="submit_form_password" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Confirma nova senha</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required/>
                                                </div>
                                            </div>
                                            <div class="margin-top-10">
                                                <input class="btn green" type="submit" value="Redefinir senha">
                                                <a href="#tab_1_1" data-toggle="tab" id="btnCancel2" class="btn default"> Cancelar </a>
                                            </div>

                                        </form>

                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->

        </div>
    </div>

@endsection

@section('scripts')

    <script>

    </script>

    <script src="{{ asset('js/admin.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery.input-ip-address-control-1.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/pages/scripts/form-input-mask.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/global/plugins/jquery-validation/js/localization/messages_pt_BR.min.js') }}" type="text/javascript"></script>

@endsection