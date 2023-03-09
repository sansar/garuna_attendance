<?php

namespace App\Http\Controllers;

use App\Mail\InviteMail;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EditController extends Controller
{
    public function index(Request $request)
    {
        $uid = $request->uid;
        $edit = Attendance::where('uid', $uid)->first();
        if (empty($edit)) {
            $edit = [
                'name' => '',
                'phone' => '',
                'email' => '',
                'amount' => '',
                'paid_date' => '',
                'mail_sent' => 0,
                'attended' => 0
            ];
            if ($uid) {
                return abort(404);
            }
        }
        return view('home.edit', compact(
            'edit'
        ));
    }

    public function create()
    {
        $edit = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'amount' => '',
            'paid_date' => '',
            'uid' => '',
            'mail_sent' => 0,
            'attended' => 0
        ];
        return view('home.edit', compact(
            'edit'
        ));
    }

    public function create_attendance(Request $request): \Illuminate\Http\RedirectResponse
    {
        $uid = $request->get('uid');
        $data = ['name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'amount' => $request->get('amount'),
            'paid_date' => $request->get('paid_date'),
            'uid' => is_null($uid) ? Str::uuid() : $uid,
            'mail_sent' => is_null($request->get('mail_sent')) ? 0 : $request->get('mail_sent'),
            'attended' => is_null($request->get('attended')) ? 0 : $request->get('attended')
        ];
        Attendance::upsert($data, ['uid']);
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $uid = $request->get('uid');
        Attendance::where('uid', $uid)->delete();
        return response()->json([
            "status" => 1,
            "uid" => $uid
        ]);
    }

    public function email_send(Request $request)
    {
        $link = $request->get('link');
        $email = $request->get('email');
        $mailData = [
            'title' => 'Invitation from ' . env('MAIL_USERNAME'),
            'body' => 'Сайн байна уу',
            'subject' => 'Урилга'
        ];
        Mail::to($email)->send(new InviteMail($mailData, $link));
        return response()->json([
            "status" => 1,
            "link" => $link,
            "email" => $email
        ]);
    }
}
