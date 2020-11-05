@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('サイト作成') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('sites.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="siteName">サイト名</label>
                            <input type="text" class="form-control" name="name" id="siteName" aria-describedby="siteName" placeholder="サイト名" required>
                            <small id="siteName" class="form-text text-muted">アルファベット大文字小文字。ftpのユーザー名にもなります。</small>
                        </div>
                        <div class="form-group">
                            <label for="domainName">ドメイン名</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="domain" id="domainName" aria-describedby="domainName" placeholder="ドメイン名" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">.{{ config('rensv.domain') }}</span>
                                </div>
                            </div>
                            <small id="domainName" class="form-text text-muted">現在独自ドメインには対応していません。</small>
                        </div>
                        <div class="form-group">
                            <label for="ftpPassword">FTP パスワード</label>
                            <input type="password" class="form-control" name="ftpPassword" id="ftpPassword" aria-describedby="ftpPassword" placeholder="FTPパスワード" required>
                        </div>
                        <div class="form-group">
                            <label for="reFtpPassword">FTP パスワード(確認)</label>
                            <input type="password" class="form-control" name="reFtpPassword" id="reFtpPassword" aria-describedby="reFtpPassword" placeholder="FTPパスワード(確認)" required>
                        </div>
                        <div class="form-group">
                        <label>プラン</label>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @foreach($plans as $p)
                                <label class="btn btn-secondary">
                                    <input type="radio" name="plan" id="{{$p->id}}" value="{{$p->id}}" autocomplete="off" required> {{$p->name}}: {{$p->price}}円
                                </label>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">作成</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">キャンセル</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
