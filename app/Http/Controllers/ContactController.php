<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $a = random_int(1, 5);
        $b = random_int(1, 5);
        $request->session()->put('captcha_sum', $a + $b);

        return view('contact', compact('a', 'b'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:100'],
            'email' => ['required','email','max:255'],
            'message' => ['required','string','max:2000'],
            'captcha' => ['required','integer'],
        ]);

        $expected = (int) $request->session()->get('captcha_sum', -999);
        if ((int)$request->input('captcha') !== $expected) {
            return back()->withErrors(['captcha' => 'Капча неверная'])->withInput();
        }

        Feedback::create($request->only('name','email','message'));

        return redirect()->route('contact.show')->with('ok', 'Сообщение отправлено!');
    }
}
