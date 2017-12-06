@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @includeWhen(isset($sub_menu), 'dashboard.partials.sub-sidebar')
        <div class="content-wrapper">
            <div class="header sub-header">
            <span class="uppercase">
                <i class="ion ion-ios-information-outline"></i> Add New Site
            </span>
            <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('dashboard.partials.errors')
                    <form name="siteForm" id="siteForm" class="form-vertical" role="form" action="{{ cachet_route('dashboard.sites.add', [], 'post') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <fieldset>
                            <div class="form-group">
                                <label>Site Name:</label>
                                <input type="text" name="name" class="form-control">

                            </div>
                            <div class="form-group">
                                <label>URL:</label>
                                <input type="text" name="url" class="form-control">

                            </div>
                            <div class="form-group">
                                <label>Status:</label><br/>
                                <input name="status" type="radio" value="active" checked> Active &nbsp;
                                <input name="status" type="radio" value="inactive"> Disabled

                            </div>
                        </fieldset>

                        <div class="form-group">
                            <div class='btn-group'>
                                <button type="submit" class="btn btn-success">Create Site</button>
                                <button type="button" class="btn btn-default" onclick="document.getElementById('siteForm').reset();">Reset</button>
                                <a class="btn btn-warning" href="/dashboard/sites">{{ trans('forms.cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
