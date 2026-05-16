<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TelegramController extends Controller
{
    private $token;
    private $apiUrl;

    public function __construct()
    {
        $this->token = env('TELEGRAM_BOT_TOKEN');
        $this->apiUrl = 'https://api.telegram.org/bot' . $this->token . '/';
    }

    public function webhook(Request $request)
    {
        $update = $request->all();

        if (isset($update['message'])) {
            $this->handleMessage($update['message']);
        }

        if (isset($update['callback_query'])) {
            $this->handleCallback($update['callback_query']);
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }

    private function handleMessage(array $message)
    {
        $chatId = $message['chat']['id'];
        $lastName = $message['chat']['last_name'] ?? '';
        $firstName = $message['chat']['first_name'] ?? '';


        // /start
        if (isset($message['text']) && $message['text'] === '/start') {

            $keyboard = [
                'keyboard' => [
                    [
                        [
                            'text' => '📱 Telefon raqam yuborish',
                            'request_contact' => true
                        ]
                    ]
                ],
                'resize_keyboard' => true,
                'one_time_keyboard' => true
            ];

            $this->sendMessage(
                $chatId,
                "Iltimos telefon raqamingizni yuboring:",
                $keyboard
            );
        }

        // contact kelganda
        if (isset($message['contact'])) {

            $phone = $message['contact']['phone_number'];

            $keyboard = [
                'inline_keyboard' => [
                    [
                        [
                            'text' => '⭐ Standard',
                            'callback_data' => 'tariff_standard'
                        ],
                        [
                            'text' => '💎 Premium',
                            'callback_data' => 'tariff_premium'
                        ]
                    ]
                ]
            ];

            Subscription::query()->create([
                'telegram_id' => $chatId,
                'name' => $firstName . ' ' . $lastName,
                'phone' => $phone,
                'status' => 'pending',
            ]);

            $removeKeyboard = [
                'remove_keyboard' => true
            ];

            // oldingi contact keyboardni yopadi
            $this->sendMessage(
                $chatId,
                "Telefon raqamingiz qabul qilindi ✅",
                $removeKeyboard
            );

            // yangi tarif buttonlarini chiqaradi
            $this->sendMessage(
                $chatId,
                "Tarif tanlang:",
                $keyboard
            );
        }

        if(isset($message['photo']) || isset($message['document'])){

            $telegramFileId = null;

            // photo
            if (isset($message['photo'])) {

                $photo = end($message['photo']);

                $telegramFileId = $photo['file_id'];
            }

            // document
            if (isset($message['document'])) {

                $telegramFileId = $message['document']['file_id'];
            }

            // telegramdan file info olish
            $response = Http::get(
                $this->apiUrl . 'getFile',
                [
                    'file_id' => $telegramFileId
                ]
            );

            $filePath = $response['result']['file_path'];

            // file download url
            $fileUrl = "https://api.telegram.org/file/bot{$this->token}/{$filePath}";

            // file content
            $fileContent = Http::get($fileUrl)->body();

            // filename
            $fileName = time() . '_' . basename($filePath);

            // storagega saqlash
            Storage::disk('public')->put(
                'checks/' . $fileName,
                $fileContent
            );

            // db update
            $subscription = Subscription::query()
                ->where('telegram_id', $chatId)
                ->latest()
                ->first();

            if(!$subscription){

                $this->sendMessage(
                    $chatId,
                    "Avval tarif tanlang."
                );

                return;
            }

            $lastFile = File::query()
                ->where('subscription_id', $subscription->id)
                ->latest()
                ->first();

            // approved bo'lsa qayta yuborolmaydi
            if($subscription->status === 'approved'){

                $this->sendMessage(
                    $chatId,
                    "✅ Sizning obunangiz allaqachon tasdiqlangan."
                );

                return;
            }

            if($subscription->status === 'pending' && $lastFile){

                $this->sendMessage(
                    $chatId,
                    "⏳ Siz allaqachon chek yuborgansiz.\n\nAdmin tasdiqlashini kuting."
                );

                return;
            }

            if($subscription){

                File::query()->create([
                    'subscription_id' => $subscription->id,
                    'file_name' => $fileName,
                    'file_path' => 'checks/' . $fileName,
                    'status' => 'pending',
                ]);

                $subscription->update([
                    'status' => 'pending'
                ]);
            }

            $this->sendMessage(
                $chatId,
                "✅ To'lov cheki qabul qilindi.\n\nAdmin tasdiqlashini kuting."
            );
        }
    }

    private function handleCallback(array $callback)
    {
        $chatId = $callback['message']['chat']['id'];
        $messageId = $callback['message']['message_id'];
        $data = $callback['data'];

        if ($data === 'tariff_standard') {

            Subscription::query()
                ->where('telegram_id', $chatId)
                ->latest()
                ->first()
                ?->update(['tariff' => 'standard']);

            $text = "Siz Standard tarifni tanladingiz\n"
            . "Tarif narxi: 100 000 so'm\n"
            . "Iltimos to'lovni chekini yuboring:";
            $this->editMessage($chatId, $messageId, $text);
        }

        if ($data === 'tariff_premium') {

            Subscription::query()
                ->where('telegram_id', $chatId)
                ->latest()
                ->first()
                ?->update(['tariff' => 'premium']);

            $text = "Siz Standard tarifni tanladingiz\n"
                . "Tarif narxi: 200 000 so'm\n"
                . "Iltimos to'lovni chekini yuboring:";
            $this->editMessage($chatId, $messageId, $text);
        }
    }

    public function sendMessage($chatId, $message, $replyMarkup = null)
    {
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        if ($replyMarkup) {
            $data['reply_markup'] = json_encode($replyMarkup);
        }

        Http::post($this->apiUrl . 'sendMessage', $data);
    }

    public function editMessage($chatId, $messageId, $message)
    {
        Http::post($this->apiUrl . 'editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $message,
        ]);
    }
}
