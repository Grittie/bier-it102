<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceInformation;
use App\Models\InternalTemperature;
use App\Models\ConnectionStatus;
use Carbon\Carbon;

class DeviceInformationController extends Controller
{
    public function index()
    {
        // Fetch the latest device information (IP and MAC)
        $deviceInfo = DeviceInformation::latest()->first();

        // Fetch the latest temperature and humidity entry
        $latestTemperature = InternalTemperature::latest()->first();

        // Check the connection status
        $latestConnection = ConnectionStatus::latest()->first();
        $connectionStatus = false;
        if ($latestConnection) {
            $connectionTimestamp = Carbon::parse($latestConnection->timestamp);
            $connectionStatus = $connectionTimestamp->diffInSeconds(now()) <= 40;
        }

        // Fetch the last 60 entries for the graph
        $temperatureData = InternalTemperature::orderBy('timestamp', 'desc')->take(60)->get()->reverse();

        return view('device-information', [
            'deviceInfo' => $deviceInfo,
            'latestTemperature' => $latestTemperature,
            'connectionStatus' => $connectionStatus,
            'temperatureData' => $temperatureData,
        ]);
    }
}