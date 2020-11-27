<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RentalServer;
use App\Models\Plan;
use App\Models\FtpUser;

class SitesController extends Controller
{
    public function show(Request $request, RentalServer $site)
    {
        return view('sites.show', compact('site'));
    }

    public function create(Request $request)
    {
        $plans = Plan::get();
        return view('sites.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $item = $request->all();
        $item['user_id'] = auth()->user()->id;
        $item['plan_id'] = $item['plan'];
        $ftpPassword = $request->ftpPassword;
        unset($item['ftpPassword']);
        unset($item['reFtpPassword']);

        // とりあえずDBとそれにアクセスできるユーザーを作成
        DB::connection('mysql-user')->statement('CREATE DATABASE IF NOT EXISTS ' . $item["name"]);
        DB::connection('mysql-user')->statement('GRANT ALL ON '. $item['name'].'.* to '.$item['name']. '@`%` identified by "'. $ftpPassword .'"');

        DB::beginTransaction();
        try {
            $rentalServer = new RentalServer();
            $rentalServer->fill($item);
            $rentalServer->save();

            $ftpUser = new FtpUser();
            $ftpUser->fill([
                'name' => $item['name'],
                'password' => \DB::raw("password('$ftpPassword')"),
                'rental_server_id' => $rentalServer->id,
            ]);
            $ftpUser->save();

            $data = [
                'documentRoot' => '/var/www/html/'.$item['name'],
                'serverName' => $item['name'].'.'.config('rensv.domain'),
            ];
            \Amqp::publish('routing-key', json_encode($data, JSON_UNESCAPED_SLASHES));

            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            abort(500);
        }


        $dirPath = config('directory.dir_path');
        $dirName = $item['name'];
        $process = new Process(['mkdir',$dirPath.'/'.$dirName]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return redirect(route('sites.show', [
            'site' => $rentalServer,
        ]));
    }

    public function update(Request $request, RentalServer $site)
    {
        return view('sites.update');
    }

    public function delete(Request $request, RentalServer $site)
    {
        return view('sites.delete');
    }
}
