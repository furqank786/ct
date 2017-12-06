@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @includeWhen(isset($sub_menu), 'dashboard.partials.sub-sidebar')
        <div class="content-wrapper">
            <div class="header sub-header" id="application-setup">
            <span class="uppercase">
                Passport
            </span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form id="settings-form" name="SettingsForm" class="form-vertical" role="form" action="{{ cachet_route('dashboard.settings', [], 'post') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('dashboard.partials.errors')
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text" name="url" class="form-control" value="{{$settings['url']}}" placeholder="www.test.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Client Id</label>
                                        <input type="text" name="client_id" class="form-control" value="{{$settings['client_id']}}" placeholder="client id">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Client Secret</label>
                                        <input type="text" name="client_secret" class="form-control" value="{{$settings['client_secret']}}" placeholder="client secret">
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">{{ trans('forms.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
