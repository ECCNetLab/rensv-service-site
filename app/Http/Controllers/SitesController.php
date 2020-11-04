<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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

        $dirPath = '/tmp';
        $dirName = $item['name'];
        $process = new Process(['mkdir',$dirPath.'/'.$dirName]);
        $process->run();
        if(!$process->isSuccessful()) {
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
