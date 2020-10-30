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
                        @foreach($sites as $s)
                            <tr>
                                <td><a href="{{ route('sites.show', ['site' => $s]) }}">{{ $s->name }}</a></td>
                                <td>{{ $s->domain }}.{{ config('rensv.domain') }}</td>
                                <td>{{ $s->plan->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
