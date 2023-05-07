<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Netflie\WhatsAppCloudApi\WebHook;

class HomeController extends Controller
{
    public function sendWelcomeMessages(Request $request)
    {

        $token = "Bearer EAADHtN4W7H4BAKxPGq1SDjESDrA5HTo9T93r3lq1HZAEQhtUkqTFBg3Bvu6a8rwVoKpuZBUybrq69BC3eWKLtfkPi9kjFQHz6RfnPrCI6LzHnucmpuNUUMgShIDyRQVH9SP0SqZBqHVnceWTmdDD6Buj2V8358MhxKiF2XqBbgCo8iZBP5LAYKK6kmqGfvrhd1WFcNDTgLEyZBBxFuhZAQuNVoZCFB9bVIZD";

        $json = [
            "messaging_product" => 'whatsapp',
            "recipient_type" => 'individual',
            "to" => "201111289180",
            "type" => "interactive",
            "interactive" => [
                "type" => "list",
                "header" => [
                    "type" => "text",
                    'text' => "فاروق جروب للتجاره الالكترونيه والبرمجه",
                ],
                "body" => [
                    "text" => "مجموعه الكورسات",
                ],
                "action" => [
                    "button" => "اختر من القائمه",
                    "sections" => [
                       [
                           "title" => "اداره الاعمال",
                           "rows" => [
                               [
                                   "id" => "one_corses_farouk",
                                   "title" => "كورس اداره الاعمال",
                                   "description" => "اداره الاعمال",
                               ],
                               [
                                   "id" => "hww_corses_farouk",
                                   "title" => "كورس اداره الاعمال",
                                   "description" => "اداره الاعمال",
                               ],
                           ],
                       ]
                    ]
                ]
            ]
        ];

        $response = Http::withBody(json_encode($json), 'application/json')->withHeaders(['Authorization' => $token, 'Content-Type' => 'application/json'])
            ->post('https://graph.facebook.com/v16.0/100702159672566/messages');
        if ($response->status() == 200) {
            return $response->body();
        }
    }


    public function webhook(Request $request)
    {

        $webhook = new WebHook();
        return $webhook->verify($_GET,"whatsappapplactions4561");

//        try {
//            $token = "whatsappapplactions4561";
//            $query = $request->query();
//            $challenge = $request->hub_challenge;
//            $mode = $request->hub_mode;
//            $verify_token = $request->hub_verify_token;
//            return response()->json($request->all());
//        }catch (\Exception $exception){
//            return response()->json(['status' => 'Error']);
//        }

    }


    public function notifications_webhook(Request $request)
    {
        $payload = file_get_contents('php://input');
        fwrite(STDOUT, print_r($payload, true) . "\n");
        $webhook = new WebHook();
        fwrite(STDOUT, print_r($webhook->read(json_decode($payload, true)), true) . "\n");
    }
}
