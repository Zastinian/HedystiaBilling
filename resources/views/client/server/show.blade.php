@php $header_route = 'client.server.index'; @endphp

@extends('layouts.client')

@inject('plan_model', 'App\Models\Plan')

@php
    $plan = $plan_model->find($server->plan_id);
@endphp

@section('title', 'Server Info')
@section('header', 'My Servers')
@section('subheader', "Server #${id}")

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Server Information</h5>
                </div>
                <div class="card-body text-nowrap row">
                    <p class="card-text col-5">
                        <b>Plan Name</b><br>
                        <b>Server Name</b><br>
                        <b>Server Status</b>
                    </p>
                    <p class="card-text col-7">
                        {{ $plan->name }}<br>
                        {{ $server->server_name }}
                        <br>
                        <span id="server_status"><span class="badge bg-warning">Active</span></span>
                    </p>
                    <a href="{{ route('client.server.plan.show', ['id'=>$id]) }}" class="btn btn-primary btn-sm col-12">Plan <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Billing Overview</h5>
                </div>
                <div class="card-body text-nowrap row">
                    <p class="card-text col-7">
                        <b>Recurring Amount</b><br>
                        <b>Billing Cycle</b><br>
                        <b>Server Creation Date</b><br>
                        <b>Due Date</b><br>
                        <b>Payment Method</b><br>
                        <b>Backup Payment Method</b>
                    </p>
                    <p class="card-text col-5">
                        {!! session('currency')->symbol !!}{{ number_format($plan->price * session('currency')->rate, 2) }} {{ session('currency')->name }}<br>
                        {{ $server->plan_cycle }}<br>
                        {{ $server->created_at }}<br>
                        {{ $server->due_date }}<br>
                        {{ $server->payment_method }}<br>
                        Account Credit
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Resources</h5>
                </div>
                <div class="card-body text-nowrap row">
                    <p class="card-text col-5">
                        <b>RAM</b><br>
                        <b>CPU</b><br>
                        <b>Disk</b><br>
                        <b>Databases</b><br>
                        <b>Backups</b><br>
                        <b>Extra Ports</b>
                    </p>
                    <p class="card-text col-7">
                        <span id="memory_usage"></span>{{ $plan->ram }} MB<br>
                        <span id="cpu_usage"></span>{{ $plan->cpu }}%<br>
                        <span id="disk_usage"></span>{{ $plan->disk }} MB<br>
                        <span id="database_usage"></span>{{ $plan->databases }}<br>
                        <span id="backup_usage"></span>{{ $plan->backups }}<br>
                        <span id="extra_port_usage"></span>{{ $plan->allocations - 0 }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Quick Shortcuts</h5>
                </div>
                <div class="card-body text-nowrap row">
                    <p class="card-text col-lg-4 col-6">
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}"><i class="fas fa-terminal"></i> Console</a><br>
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/files"><i class="fas fa-folder-open"></i> Files</a><br>
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/databases"><i class="fas fa-database"></i> Databases</a><br>
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/schedules"><i class="fas fa-table"></i> Schedules</a>
                    </p>
                    <p class="card-text col-lg-4 col-6">
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/users"><i class="fas fa-users"></i> Users</a><br>
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/backups"><i class="fas fa-file-archive"></i> Backups</a><br>
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/network"><i class="fas fa-network-wired"></i> Network</a><br>
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/startup"><i class="fas fa-play"></i> Startup</a>
                    </p>
                    <p class="card-text col-lg-4 col-6">
                        <a href="{{ config('app.panel_url') }}/server/{{ $server->identifier }}/settings"><i class="fas fa-cogs"></i> Settings</a><br>
                        @if (config('app.phpmyadmin_url')) <a href="{{ config('app.phpmyadmin_url') }}"><i class="fas fa-tools"></i> phpMyAdmin</a> @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
