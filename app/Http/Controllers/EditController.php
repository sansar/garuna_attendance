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
        $request->validate([
            'email' => 'email:required,email'
        ]);
        $data = $request->all();
        $mailer = new InviteMail($data, $data['link'] . '?a=true');
        Mail::to($data['email'])->send($mailer);
        $user = Attendance::where('uid', $data['uid'])->first();
        if ($user != null) {
            $user->mail_sent = 1;
            $user->email = $data['email'];
            $user->save();
        }
        return response()->json([
            "status" => 1
        ]);
    }

    public function attend(Request $request) {
        $uid = $request->get('uid');
        $user = Attendance::where('uid', $uid)->first();
        if ($user != null) {
            $user->attended = 1;
            $user->save();
        }
        return response()->json(['status' => 1]);
    }
}
