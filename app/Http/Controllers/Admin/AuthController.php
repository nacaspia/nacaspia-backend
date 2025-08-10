<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(auth('admin')->user())) {
            return redirect()->route('admin.sliders.index');
        }
        return view('admin.auth.login');
    }

    public function loginAccept(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $captcha = $request->captcha;
        $valdate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => ['required', 'min:6'/*, 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/'*/],
//            'captcha' => ['required']
        ], [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
            'password.min' => Lang::get('validation.min.string', ['attribute' => 'password', 'min' => 6]),
            'password.regex' => Lang::get('validation.regex', ['attribute' => 'password']),
        ]);

        if ($valdate->fails())
        {
            return redirect()->back()->with('errors', $valdate->errors());
        }elseif ($valdate->passes()) {
            /*$captcha = self::verifyCaptcha($captcha);
            if (!$captcha)
            {
                return redirect()->back()->with('errors' ,'Qeyd etdiyiniz simvolar doğru deyildir.');
            }*/
            $loginState = [
                'email' => $email,
                'password' => $password
            ];

            if (!empty(auth('admin')->attempt($loginState))) {
                return redirect(route('admin.index'))->with('success', Lang::get('admin.success_login'));
            } else {
                return redirect()->back()->with('errors', Lang::get('admin.error_login'));
            }
        }
    }


    public function generateCaptcha(Request $request)
    {
        // Rastgele 6 karakterli CAPTCHA kodu oluştur
        $captchaCode = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);
        // CAPTCHA kodunu session'a kaydet
        Session::put('captcha', $captchaCode);
        // CAPTCHA resmi oluştur
        $image = imagecreate(120, 40);

        if($request->get('p') == '1') {
            $bgColor = imagecolorallocate($image, 239, 140, 97);
        } else {
            // Arxa fon rəngini #22ca46 (yaşıl) et
            $bgColor = imagecolorallocate($image, 13, 153, 255);
        }

        // Mətn rəngini ağ et ki, oxunaqlı olsun
        $textColor = imagecolorallocate($image, 255, 255, 255);
        imagestring($image, 5, 30, 10, $captchaCode, $textColor);
        // Resmi tarayıcıya PNG formatında gönder
        header("Content-type: image/png");
        imagepng($image);
        imagedestroy($image);
    }

    public static function verifyCaptcha($captcha)
    {
        // Session'daki doğru CAPTCHA kodu
        $storedCaptcha = Session::get('captcha');
        if (!empty($captcha) && $captcha === $storedCaptcha) {
            Session::remove('captcha');
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        auth('admin')->logout(); // admin guard-ı ilə çıxış et
        \Session::forget('admin_data');
        return redirect(route('admin.login'))->with('success', Lang::get('admin.success_logout'));
    }
}
