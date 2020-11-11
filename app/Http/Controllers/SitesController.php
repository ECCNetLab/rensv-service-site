<?php

namespace App\Http\Controllers;

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
                'serverName' => $item['name'].'.netlab.ecc.ac.jp',
            ];
            \Amqp::publish('routing-key', json_encode($data,JSON_UNESCAPED_SLASHES));

            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            abort(500);
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
