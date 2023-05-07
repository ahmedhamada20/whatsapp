<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Netflie\WhatsAppCloudApi\WebHook;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
define('STDOUT', fopen('php://stdout', 'w'));
class HomeController extends Controller
{

    public function notifications_webhook(Request $request)
    {
        // Read the raw POST data from the request
        $payload = $request->getContent();

        // Print the payload to the log for debugging purposes
        info($payload);

        // Instantiate the Webhook super class
        $webhook = new WebHook();

        // Parse the payload into an array and pass it to the WebHook class's read method
        $result = $webhook->read(json_decode($payload, true));

        // Print the result to the log for debugging purposes
        info(print_r($result, true));

        // Return a response to the incoming request (if needed)
        return response('OK');

//        $payload = $request->getContent();
//        fwrite(STDOUT, print_r($payload, true) . "\n");
//        $webhook = new WebHook();
//        dd($webhook->read($payload));
//        fwrite(STDOUT, print_r($webhook->read(json_decode($payload, true)), true) . "\n");
    }

    public function sendMessages(Request $request)
    {
        $whatsapp_cloud_api = new WhatsAppCloudApi([
            "from_phone_number_id" => 100702159672566,
            "access_token"=> "EAADHtN4W7H4BAN4eZCpgSUVnvYfFZBS8KwIGz26xEukZBgV7JVdt6lekE3iDgPWaQu7dzKsH3t5BZCMXYfXNDaaSDhZCihdyhrjhVJPUHvowALBV5h874dEDtYvrvaijgvkaPeFiIVMBhf4CAR5vZAFHtR7T7Cl9PmhBZARvgxTJjP75lLxVriT8SfXwiOQwNN18LEQ9lXBNQNT06Ohiu8aEELmCWQ8rqAZD",
        ]);
        $whatsapp_cloud_api->sendTextMessage('201111289180','Halo Ahmed Hamad Welcome back');
        return "done";
    }

    public function index(Request $request)
    {
        $token = "meatyhamhock";
        $query = $request->query();
        $challenge = $request->hub_challenge;
        $mode = $request->hub_mode;
        $verify_token = $request->hub_verify_token;
        if ($mode && $verify_token && $challenge) {
            if ($mode == "subscribe" && $verify_token == $token) {
//                return redirect()->route('home');
                return response()->json(['status' => 'success']);
            }
        } else {
            return response()->json(['status' => 'Error']);
        }


    }
}
