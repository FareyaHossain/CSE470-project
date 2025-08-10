<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function handle(Request $request)
    {
        $message = strtolower($request->input('message'));
        $response = "Sorry, I didn’t understand that.";

        if (str_contains($message, 'leave')) {
            $response = "To apply for leave, go to the Leave Request page and fill out the form.";
        } elseif (str_contains($message, 'holiday')) {
            $response = "The next holiday is on 15th August (Independence Day).";
        } elseif (str_contains($message, 'balance')) {
            $response = "You have 7 leave days remaining.";
        }

        return response()->json(['response' => $response]);
    }
}
