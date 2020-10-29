@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('サイト一覧') }}</div>

                <div class="card-body">
                    <a class="mx-auto btn btn-primary" href="{{ route('sites.create') }}">
                        サイトを作る
                    </a >
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>サイト名</th>
                                <th>ドメイン</th>
                                <th>プラン</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>test</td>
                                <td>test.example.com</td>
                                <td>standard</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
