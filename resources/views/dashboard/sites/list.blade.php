@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @includeWhen(isset($sub_menu), 'dashboard.partials.sub-sidebar')
        <div class="content-wrapper">
            <div class="header sub-header">
            <span class="uppercase">
                <i class="ion ion-ios-information-outline"></i> Manage Sites
            </span>
                <a class="btn btn-md btn-success pull-right" href="{{ cachet_route('dashboard.sites.add') }}">
                    Add New Site
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('dashboard.partials.errors')
                    <div class="row striped-list-item">
                        <div class="col-xs-3">
                            <b>Site Name</b>
                        </div>
                        <div class="col-xs-3">
                            <b> URL</b>
                        </div>
                        <div class="col-xs-1">
                            <b>Status</b>
                        </div>
                        <div class="col-xs-3">
                            <b>Created at</b>
                        </div>
                        <div class="col-xs-1">
                            <b>Action</b>
                        </div>
                    </div>
                    <hr/>
                    <div class="striped-list">
                        @foreach($sites as $site)
                            <div class="row striped-list-item">
                                <div class="col-xs-3">
                                    <p>{{ $site->name }}</p>
                                </div>
                                <div class="col-xs-3">
                                    {{$site->url}}
                                </div>
                                <div class="col-xs-1">
                                    {{ucfirst($site->status)}}
                                </div>

                                <div class="col-xs-3">
                                    {{date('m/d/Y h:i:s a',strtotime($site->created_at))}}
                                </div>
                                <div class="col-xs-1 text-right">
                                    <a href="sites/update/id/{{$site->id}}/status/{{ $site->status === "active" ? "inactive" : "active" }}" onclick="if(confirm('Are you sure? You want to update site status!')) { return true;} else {return false;}">{{ $site->status === "active" ? "Inactive" : "Active" }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
