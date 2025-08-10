<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CareerContact;
use App\Models\Contact;
use App\Models\Service;
use App\Models\ServiceContact;
use App\Models\Setting;
use App\Notifications\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AjaxController extends Controller
{
    protected $currentLang;
    protected $setting;

    public function __construct()
    {
        $this->currentLang = LaravelLocalization::getCurrentLocale();
        if (!in_array($this->currentLang,['az','en','ru'])){
            return self::notFound();
        }
        $this->setting = Setting::first();
    }

    public function notFound()
    {
        $currentLang = $this->currentLang;
        return view('site.not_found',compact('currentLang'));
    }

    public function sendCareerApply(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'patronymic' => 'required|string|max:255',
                'number' =>  'required|string|max:20|regex:/^\+994[0-9]{9}$/',
                'address' => 'required|string|max:255',
                'email' => 'required|email',
                'cvInput' => 'required|file|mimes:pdf,doc,docx',
                'photoInput' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ], [
                'name.required' => Lang::get('site.name_required'),
                'surname.required' => Lang::get('site.surname_required'),
                'patronymic.required' => Lang::get('site.patronymic_required'),
                'number.required' => 'Telefon nömrəsi mütləqdir.',
                'number.string' => 'Telefon nömrəsi mətn formatında olmalıdır.',
                'number.max' => 'Telefon nömrəsi maksimum 20 simvol ola bilər.',
                'number.regex' => 'Telefon nömrəsi "+994XXXXXXXXX" formatında olmalıdır.',
                'address.required' =>  Lang::get('site.address_required'),
                'email.required' => Lang::get('site.email_required'),
                'cvInput.required' => Lang::get('site.cv_required'),
                'cvInput.mimes' => Lang::get('site.cv_max'),
                'cvInput.max' => Lang::get('site.cv_min'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $captcha = self::verifyCaptcha($request->captcha);
            if (!$captcha)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Qeyd etdiyiniz simvolar doğru deyildir.',
                ]);
            }

            if ($request->hasFile('photoInput')) {
                $photoInput = time().$request->photoInput->extension();
                $request->photoInput->move(public_path('uploads/careerApply/photo'), $photoInput);
            }
            if ($request->hasFile('cvInput')) {
                $cvInput = time().$request->cvInput->extension();
                $request->cvInput->move(public_path('uploads/careerApply/cv'), $cvInput);
            }

            CareerContact::create([
                'career_id' => $request->career_id ?? null,
                'is_vacancy' => $request->is_vacancy ?? null,
                'name' => $request->name,
                'surname' => $request->surname,
                'father_name' => $request->patronymic,
                'phone' => $request->number,
                'address' => $request->address,
                'email' => $request->email,
                'education' => $request->education,
                'experience' => $request->work_experience,
                'language' => $request->language ,
                'image' => !empty($photoInput) ? $photoInput: null,
                'resume' => !empty($cvInput) ? $cvInput: null,
            ]);

            $mail_data = [
                'career_id' => $request->career_id ?? null,
                'is_vacancy' => $request->is_vacancy ?? null,
                'name' => $request->name,
                'surname' => $request->surname,
                'father_name' => $request->patronymic,
                'phone' => $request->number,
                'address' => $request->address,
                'email' => $request->email,
                'education' => $request->education,
                'experience' => $request->work_experience,
                'language' => $request->language,
                'image' => !empty($photoInput) ? 'uploads/careerApply/photo/' . $photoInput : null,
                'resume' => !empty($cvInput) ? 'uploads/careerApply/cv/' . $cvInput : null,
                'type' => 'vacancy'
            ];

            Notification::route('mail', $this->setting->email)->notify(new Mail($mail_data));

            return response()->json([
                'success' => true,
                'message' => 'Müraciət uğurla göndərildi!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => null,
            ]);
        }
    }

    public function sendVolunteerApply(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'patronymic' => 'required|string|max:255',
                'number' =>  'required|string|max:20|regex:/^\+994[0-9]{9}$/',
                'address' => 'required|string|max:255',
                'email' => 'required|email'
            ], [
                'name.required' => Lang::get('site.name_required'),
                'surname.required' => Lang::get('site.surname_required'),
                'patronymic.required' => Lang::get('site.patronymic_required'),
                'number.required' => 'Telefon nömrəsi mütləqdir.',
                'number.string' => 'Telefon nömrəsi mətn formatında olmalıdır.',
                'number.max' => 'Telefon nömrəsi maksimum 20 simvol ola bilər.',
                'number.regex' => 'Telefon nömrəsi "+994XXXXXXXXX" formatında olmalıdır.',
                'address.required' =>  Lang::get('site.address_required'),
                'email.required' => Lang::get('site.email_required')
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $captcha = self::verifyCaptcha($request->captcha);
            if (!$captcha)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Qeyd etdiyiniz simvolar doğru deyildir.',
                ]);
            }

            CareerContact::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'father_name' => $request->patronymic,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'phone' => $request->number,
                'email' => $request->email,
                'address' => $request->address,
                'actual_address' => $request->actual_address,
                'education' => $request->education,
                'language' => $request->language,
                'volunteer_expectations' => $request->volunteer_expectations,
                'volunteer_differences' => $request->volunteer_differences,
                'is_volunteer' => ($request->is_volunteer != null || !empty($request->voluntary_other_text))? 1: null,
                'voluntary_other_text' => $request->voluntary_other_text,
                'voluntary_leaving_reason' => $request->voluntary_leaving_reason,
                'is_vacancy' => 0
            ]);

            $mail_data = [
                'name' => $request->name,
                'surname' => $request->surname,
                'father_name' => $request->patronymic,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'phone' => $request->number,
                'email' => $request->email,
                'address' => $request->address,
                'actual_address' => $request->actual_address,
                'education' => $request->education,
                'language' => $request->language,
                'volunteer_expectations' => $request->volunteer_expectations,
                'volunteer_differences' => $request->volunteer_differences,
                'is_volunteer' => ($request->is_volunteer != null || !empty($request->voluntary_other_text))? $request->is_volunteer: null,
                'voluntary_other_text' => $request->voluntary_other_text,
                'voluntary_leaving_reason' => $request->voluntary_leaving_reason,
                'type' => 'volunteer'
            ];

            Notification::route('mail', $this->setting->email)->notify(new Mail($mail_data));

            return response()->json([
                'success' => true,
                'message' => 'Müraciət uğurla göndərildi!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => null,
            ]);
        }
    }

    public function sendContact(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'phone' => 'required|string|max:20|regex:/^\+994[0-9]{9}$/',
                'email' => 'required|email',
                'note' => 'required',
            ], [
                'name.required' => Lang::get('site.name_required'),
                'surname.required' => Lang::get('site.surname_required'),
                'phone.required' => Lang::get('site.number_required'),
                'phone.regex' => Lang::get('site.number_regex'),
                'email.required' => Lang::get('site.email_required'),
                'note.required' => Lang::get('site.note_required'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $captcha = self::verifyCaptcha($request->captcha);
            if (!$captcha)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Qeyd etdiyiniz simvolar doğru deyildir.',
                ]);
            }

            Contact::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->note,
            ]);

            $mail_data = [
                'name' => $request->name,
                'surname' => $request->surname,
                'phone' => $request->phone,
                'email' => $request->email,
                'note' => $request->note,
                'type' => 'contact'
            ];

            Notification::route('mail', $this->setting->email)->notify(new Mail($mail_data));

            return response()->json([
                'success' => true,
                'message' => 'Müraciət uğurla göndərildi!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => null,
            ]);
        }
    }

    public function sendServiceContact(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'region_name' => 'required|string|max:255',
                'phone' =>  'required|string|max:20|regex:/^\+994[0-9]{9}$/',
                'email' => 'required|email',
                'application_example' => 'file|mimes:pdf,doc,docx',
                'card_speed' => 'file|mimes:pdf,doc,docx',
                'power_of_attorney' => 'file|mimes:pdf,doc,docx',
            ], [
                'full_name.required' => Lang::get('site.name_required'),
                'region_name.required' => Lang::get('site.surname_required'),
                'phone.required' => Lang::get('site.number_required'),
                'phone.regex' => Lang::get('site.number_regex'),
                'email.required' => Lang::get('site.email_required')
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $captcha = self::verifyCaptcha($request->captcha);
            if (!$captcha)
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Qeyd etdiyiniz simvolar doğru deyildir.',
                ]);
            }

            if ($request->hasFile('application_example')) {
                $application_example = time().$request->application_example->extension();
                $request->application_example->move(public_path('uploads/service-contact'), $application_example);
            }

            if ($request->hasFile('card_speed')) {
                $card_speed = time().$request->card_speed->extension();
                $request->card_speed->move(public_path('uploads/service-contact'), $card_speed);
            }

            if ($request->hasFile('power_of_attorney')) {
                $power_of_attorney = time().$request->power_of_attorney->extension();
                $request->power_of_attorney->move(public_path('uploads/service-contact'), $power_of_attorney);
            }

            ServiceContact::create([
                'service_id' => $request->service_id,
                'full_name' => $request->full_name ?? 0,
                'region_name' => $request->region_name ?? 0,
                'tin_enterprise' => $request->tin_enterprise ?? 0,
                'training_topic' => $request->training_topic ?? 0,
                'training_format' => $request->training_format ?? 0,
                'advisory_consulting' => $request->advisory_consulting ?? 0,
                'evaluation' => $request->evaluation ?? 0,
                'employees_count' => $request->employees_count ?? 0,
                'contract_value' => $request->contract_value ?? 0,
                'application_example' => $application_example ?? 0,
                'card_speed' => $card_speed ?? 0,
                'bank_visits' => $request->bank_visits ?? 0,
                'power_of_attorney' => $power_of_attorney ?? 0,
                'phone' => $request->phone ?? 0,
                'address' => $request->address ?? 0,
                'note' => $request->note ?? 0,
                'is_deleted' => 0,
                'datetime' => Carbon::now()
            ]);
            $service = Service::where(['status' => 1,'id' => $request->service_id])->first();

            $mail_data = [
                'service_name' => $service['title']['az'],
                'full_name' => $request->full_name,
                'region_name' => $request->region_name ?? null,
                'tin_enterprise' => $request->tin_enterprise ?? null,
                'training_topic' => $request->training_topic ?? null,
                'training_format' => $request->training_format ?? null,
                'advisory_consulting' => $request->advisory_consulting ?? null,
                'evaluation' => $request->evaluation ?? null,
                'employees_count' => $request->employees_count ?? null,
                'contract_value' => $request->contract_value ?? null,
                'application_example' => !empty($application_example)? 'uploads/service-contact/'.$application_example: null,
                'card_speed' => !empty($card_speed)? 'uploads/service-contact/'.$card_speed: null,
                'bank_visits' => $request->bank_visits ?? null,
                'power_of_attorney' => !empty($power_of_attorney)? 'uploads/service-contact/'.$power_of_attorney: null,
                'email' => $request->email ?? null,
                'phone' => $request->phone ?? null,
                'address' => $request->address ?? null,
                'note' => $request->note ?? null,
                'type' => 'service'
            ];

            Notification::route('mail', $this->setting->email)->notify(new Mail($mail_data));

            return response()->json([
                'success' => true,
                'message' => 'Müraciət uğurla göndərildi!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => null,
            ]);
        }
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
}
