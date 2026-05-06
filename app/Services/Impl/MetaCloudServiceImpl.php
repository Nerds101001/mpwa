<?php

namespace App\Services\Impl;

use App\Services\WhatsappService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaCloudServiceImpl implements WhatsappService
{
    private $baseUrl = 'https://graph.facebook.com/v20.0';

    public function fetchGroups($device): object 
    {
        // Not directly supported in Meta API the same way as Baileys
        return (object)['status' => false, 'message' => 'Not implemented in Meta API'];
    }
	
	public function fetchChannel($device, $data): object
    {
        return (object)['status' => false, 'message' => 'Not implemented in Meta API'];
    }

    public function startBlast($data): object
    {
        // handled via queues/jobs usually, just return success mock
        return (object)['status' => true];
    }

    public function sendText($request, $receiver): object | bool
    {
        try {
            // In Meta API, 'sender' in the request would be the PhoneNumberID
            // The Access Token should be retrieved from config or database based on the sender
            
            $phoneNumberId = $request->sender; // Assuming the 'token/sender' field holds the Phone Number ID
            // For now fetching token from env or assuming passed in request, but ideally from DB
            $accessToken =  env('META_ACCESS_TOKEN'); // Placeholder

            $url = "{$this->baseUrl}/{$phoneNumberId}/messages";
            
            $response = Http::withToken($accessToken)->post($url, [
                'messaging_product' => 'whatsapp',
                'recipient_type'    => 'individual',
                'to'                => $receiver,
                'type'              => 'text',
                'text'              => [
                    'preview_url' => false,
                    'body'        => $this->randomizeText($request->message, $receiver)
                ]
            ]);

            $responseData = $response->json();

            // Transform response to match expected format
             if ($response->successful()) {
                return (object) [
                    'status' => true,
                    'data' => $responseData,
                    'message' => 'Message sent via Meta API'
                ];
            }

            Log::error("Meta API Error: " . $response->body());
            return (object) [
                'status' => false,
                'message' => $responseData['error']['message'] ?? 'Unknown error'
            ];

        } catch (\Throwable $th) {
            Log::error($th);
            return (object) ['status' => false, 'message' => $th->getMessage()];
        }
    }
	
	public function sendLocation($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }
	
	public function sendVcard($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }

    public function sendMedia($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }
	
	public function sendProduct($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }
	
	public function sendTextChannel($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }
	
	public function sendSticker($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }

    public function sendButton($request, $receiver): object | bool
    {
         // Meta API equivalent is Template Messages with Buttons
         return (object)['status' => false, 'message' => 'Buttons require templates in Meta API'];
    }

    public function sendList($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }

    public function sendPoll($request, $receiver): object | bool
    {
        return (object)['status' => false, 'message' => 'Not implemented yet'];
    }

    public function logoutDevice($device): object | bool
    {
        // different concept in cloud api
         return (object)['status' => true];
    }

    public function checkNumber($device, $number): object | bool
    {
        // Meta API has an endpoint for this but it's different
         return (object)['status' => true];
    }

    private function randomizeText($text, $receiver = "")
	{
		$text = preg_replace_callback('/{([^{}|]+(?:\|[^{}|]+)+)}/', function ($matches) {
			$options = explode('|', $matches[1]);
			return $options[array_rand($options)];
		}, $text);
		
		if($receiver != ""){
			$text = str_replace('{number}', $receiver, $text);
		}

		return $text;
	}
}
