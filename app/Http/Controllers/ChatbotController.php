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
            $response = "The next holiday is on 15th-20th August (Eid Holiday).";
         } elseif (str_contains($message, 'hi')) {
            $response = "hello, welcome to HR chatbot Assistant! How can i help you?.";
        } elseif (str_contains($message, 'balance')) {
            $response = "You have 7 leave days remaining.";

        }elseif (str_contains($message, 'attendance')) {
            $response = "You can check your attendance record on the Attendance Report page.";

        }elseif (str_contains($message, 'salary')) {
            $response = "Your salary will be calculated at the end of the month based on average performance.";

        } elseif (str_contains($message, 'performance')) {
           $response = "Performance reports are available in the Performance section .";

        } elseif (str_contains($message, 'working hours')) {
            $response = "Official working hours are from 9:00 AM to 5:00 PM, Sunday to Thursday.";
        } elseif (str_contains($message, 'contact')) {
            $response = "For further assistance, please contact HR at staffmanagementhub@gmail.com.";
        
        } elseif (str_contains($message, 'help')) {
    $response = "You can ask about leave, attendance, salary, performance, holidays, or contact information.";
}
     return response()->json(['response' => $response]);
    }
}
