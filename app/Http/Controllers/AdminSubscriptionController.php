<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminSubscriptionController extends Controller
{
    public function index(){
        $user = auth()->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $subscription = Subscription::with('files')->get();


        return response()->json([
            'status' => 'ok',
            'subscription' => $subscription,
        ]);
    }

    public function approvedSubscription(int $subscriptionId)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $subscriptions = Subscription::with('files')->find($subscriptionId);
        if($subscriptions->status === 'approved'){
            return response()->json(['message' => 'Subscription already approved'], 400);
        }
        if($subscriptions->status === 'rejected'){
            return response()->json(['message' => 'Subscription already rejected'], 403);
        }

            foreach ($subscriptions->files as $file) {
                if ($file->status === 'pending') {
                    $file->update(['status' => 'approve']);
                }
        }
        $subscriptions->update(['status' => 'approved']);

        // telegramga habar
        $this->sendTelegramMessage(
            $subscriptions->telegram_id,
            "✅ Sizning obunangiz tasdiqlandi."
        );

        return response()->json([
            'status' => 'ok',
            'subscription' => $subscriptions,
        ]);
    }

    public function rejectedSubscription(int $subscriptionId)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $subscriptions = Subscription::with('files')->find($subscriptionId);
        if($subscriptions->status === 'rejected'){
            return response()->json(['message' => 'Subscription already rejected'], 400);
        }
        if($subscriptions->status === 'approved'){
            return response()->json(['message' => 'Subscription already confirmed'], 403);
        }

            foreach ($subscriptions->files as $file) {
                if ($file->status === 'pending') {
                    $file->update(['status' => 'reject']);
                }
        }
        $subscriptions->update(['status' => 'rejected']);

        // telegramga habar
        $this->sendTelegramMessage(
            $subscriptions->telegram_id,
            "❌ To'lov chekingiz rad etildi.\n\nIltimos qayta yuboring."
        );

        return response()->json([
            'status' => 'ok',
            'subscription' => $subscriptions,
        ]);
    }

    public function statistics()
    {
        $user = auth()->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $subscriptions = Subscription::query()->count();
        $approved = Subscription::query()
            ->where('tariff', 'standard')
            ->where('status', 'approved')
            ->count();
        $rejected = Subscription::query()->where('status', 'rejected')->count();

        return response()->json([
            'status' => 'ok',
            'subscriptions' => $subscriptions,
            'approved' => $approved,
            'rejected' => $rejected,
        ]);
    }

    public function searchByPhone(Request $request)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $subscriptions = Subscription::with('files')
            ->where('phone', 'like', '%' . $request->phone . '%')
            ->get();
        if(!$subscriptions){
            return response()->json(['message' => 'Subscription not found'], 404);
        }
        return response()->json([
            'status' => 'ok',
            'subscriptions' => $subscriptions,
        ]);


    }

    private function sendTelegramMessage($chatId, $message)
    {
        $token = env('TELEGRAM_BOT_TOKEN');

        Http::post(
            "https://api.telegram.org/bot{$token}/sendMessage",
            [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        );
    }
}
