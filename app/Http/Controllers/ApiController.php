<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemperatureLog;
use App\Models\ConnectionStatus;
use App\Models\Heartbeat;
use App\Models\DeviceInformation;
use Carbon\Carbon;

class ApiController extends Controller
{
    // Store temperature and humidity
    public function storeTemperature(Request $request)
    {
        $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        $entry = TemperatureLog::create([
            'timestamp' => now(),
            'temperature' => $request->input('temperature'),
            'humidity' => $request->input('humidity'),
        ]);

        return response()->json([
            'message' => 'Temperature and humidity data logged successfully.',
            'data' => $entry,
        ], 201);
    }

    // Get the latest temperature and humidity entry
    public function getLatestTemperature()
    {
        $entry = TemperatureLog::latest('timestamp')->first();

        if (!$entry) {
            return response()->json(['message' => 'No entries found.'], 404);
        }

        return response()->json($entry);
    }

    // Get the 60 most recent temperature and humidity entries
    public function getRecentTemperatures()
    {
        $entries = TemperatureLog::orderBy('timestamp', 'asc')
            ->take(60)
            ->get();

        if ($entries->isEmpty()) {
            return response()->json(['message' => 'No entries found.'], 404);
        }

        return response()->json($entries);
    }

    public function card(Request $request)
    {
        $request->validate([
            'uid' => 'required|string',
            'option' => 'required|string|in:Clock In,Clock Out,Add Pitcher',
        ]);

        // Process the card data
        // Example: Handle user clock in/clock out

        return response()->json(['message' => 'Card data processed successfully'], 200);
    }

    public function storeConnectionStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $entry = ConnectionStatus::create([
            'timestamp' => now(),
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'message' => 'Connection status logged successfully.',
            'data' => $entry,
        ], 201);
    }

    // Get the latest connection status
    public function getConnectionStatus()
    {
        $entry = ConnectionStatus::latest('timestamp')->first();

        if (!$entry) {
            return response()->json(['message' => 'No connection status found.'], 404);
        }

        return response()->json([
            'status' => $entry->status,
            'timestamp' => $entry->timestamp,
        ]);
    }

    // Store heartbeat
    public function storeHeartbeat(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $entry = Heartbeat::create([
            'timestamp' => now(),
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'message' => 'Heartbeat logged successfully.',
            'data' => $entry,
        ], 201);
    }

    // Get heartbeat status
    public function getHeartbeatStatus()
    {
        $entry = Heartbeat::latest('timestamp')->first();

        if (!$entry) {
            return response()->json(['message' => 'No heartbeat found.'], 404);
        }

        $currentTime = Carbon::now();
        $heartbeatTime = Carbon::parse($entry->timestamp);

        $status = $heartbeatTime->diffInSeconds($currentTime) > 40 ? 'ESP32 Disconnected' : $entry->status;

        return response()->json([
            'status' => $status,
            'timestamp' => $entry->timestamp,
        ]);
    }

    // Store device information
    public function storeDeviceInformation(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip',
            'mac' => 'required|string',
        ]);

        $entry = DeviceInformation::create([
            'ip' => $request->input('ip'),
            'mac' => $request->input('mac'),
        ]);

        return response()->json([
            'message' => 'Device information logged successfully.',
            'data' => $entry,
        ], 201);
    }

    // Get the latest device information
    public function getLatestDeviceInformation()
    {
        $entry = DeviceInformation::latest('created_at')->first();

        if (!$entry) {
            return response()->json(['message' => 'No device information found.'], 404);
        }

        return response()->json([
            'ip' => $entry->ip,
            'mac' => $entry->mac,
            'timestamp' => $entry->created_at,
        ]);
    }

    public function resetESP32()
    {
        // Log the reset attempt
        \Log::info('Reset request received.');

        // Return a response to indicate the reset request was successful
        return response()->json([
            'status' => 'success',
            'message' => 'ESP32 is resetting...'
        ], 200);
    }
}
