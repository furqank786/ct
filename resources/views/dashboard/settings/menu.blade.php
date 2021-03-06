@extends('layout.dashboard')

@section('content')
    <div class="content-panel" xmlns="http://www.w3.org/1999/html">
        @includeWhen(isset($sub_menu), 'dashboard.partials.sub-sidebar')
        <div class="content-wrapper">
            <div class="header sub-header" id="application-setup">
            <span class="uppercase">
                Menu
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
                                        <label>Header</label>
                                        <textarea name="header" class="form-control" rows="6" placeholder="header">{{$settings['header']}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Footer</label>
                                        <textarea name="footer" class="form-control" rows="6" placeholder="footer">{{$settings['footer']}}</textarea>
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