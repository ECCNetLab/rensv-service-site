@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('サイト情報') }}</div>

                <div class="card-body">
                    サイトの情報

                    <table class="table">
                        <tr>
                            <th>FTP URL</th>
                            <td>{{ config('rensv.ftp_url') }}</td>
                        </tr>
                        <tr>
                            <th>FTP User</th>
                            <td>{{ $site->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
