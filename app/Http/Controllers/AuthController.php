<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Client;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Redirect;
use Mail;
use App\Mail\NotifyMail;
use App\Models\Balance;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function signup(Request $request)
    {
        $messages = $this->getMessages();

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/(01)[0-9]{9}/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
        ],
            'governorates' => ['required', 'string'],
            'accept_terms' => ['required'],
        ], $messages);

        DB::beginTransaction();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        $user->accept_terms = 1;
        $user->userable_id = $user->id;

        if($request->user_type == 'lawyer'){
            $user->userable_type = 'App\Models\Lawyer';


            $lawyer_data = array(
                'governorates' => $request->governorates, 'id' => $user->id, 'court_name' => $request->court_name, 'status' => 0, 'profile_image' => 'profile_placeholder.png'
            );

            Lawyer::insert($lawyer_data);
            $lawyer = Lawyer::find($user->id);

            $image = $request->file('id_photo');
            if ($image) {
    
                $originalName = $image->getClientOriginalName();
                $fileName = time() . '_' . $originalName;
                $image->move('uploads/', $fileName);
                $lawyer->id_photo = $fileName;
            }
            
            Mail::to($user->email)->send(new NotifyMail($user, 'emails.EmailVerified', 'Under Review', ''));

            $lawyer->save();
        }
        elseif($request->user_type == 'client'){
            $user->userable_type = 'App\Models\Client';
            $client = array(
                'governorates' => $request->governorates, 'id' => $user->id, 'profile_image' => 'profile_placeholder.png'
            );

            Client::insert($client);

        }
        $user->save();

        $balance = new Balance(['user_id' => $user->id]);
        $user->balance()->save($balance);

        DB::commit();

        \Auth::login($user, true);
  
        return \Redirect::route($request->user_type.'.dashboard');

        // return response()->json(['success'=>'Laravel ajax example is being processed.']);

    }

    public function signin(Request $request)
    {
        $Emailrules    = $this->getLoginRuleEmail();
        $Phonerules    = $this->getLoginRulePhone();
        $messages      = $this->getMessages();

        $logins = $request->credentials;
        
        $pass = $request->validate([
            'credentials' => 'required',
            'password' => 'required',
        ], $messages);
        
        // $remember_me = $request->has('remember_me') ? true : false; 
        
        if (Auth::attempt(['email' => $request->credentials, 'password' => $request->password])) {
            $user = User::where('email', $request->credentials)->first();
        } 

        elseif (Auth::attempt(['phone' => $request->credentials,'password' => $request->password])) {
            $user = User::where('phone', $request->credentials)->first();
        } 

        else {
            session()->flash('message','برجاء التآكد من صحة بياناتك');
            return redirect()->back();
        }

        // return $user;

        if($user->userable_type == 'App\Models\Lawyer')
        {
            session()->flash('success', 'مرحبا بك');
            return redirect()->route('lawyer.dashboard')
            ->withInput();
        }
        else
        {
            session()->flash('success', 'مرحبا بك');
            return redirect()->route('client.dashboard')
            ->withInput();
        }

    }

    public function changepass(Request $request)
    {
      

        $messages = $this->getMessages();
        $data = $request->validate([
            'old_password'     =>    'required',
            'new_password'     =>    'required|string|min:8|different:old_password',
            'new_password_confirmation' => 'required|same:new_password'
        ], $messages);

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            $message = "كلمة المرور المدخلة غير صحيحة، حاول مجددا";
            return \Redirect::back()->withErrors($message);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $message = "تم تغيير كلمة المرور بنجاح";
        Flash::success($message);
        return \Redirect::back()->withInput();
        
    }

    public function update_profile(Request $request)
    {
        $messages = $this->getMessages();

        if(auth()->user()->userable_type == 'App\Models\Lawyer')
        {
            $data = $request->validate([
                'first_name'        =>   'nullable|string|max:255',
                'last_name'         =>   'nullable|string|max:255',
                'email'             =>   'nullable|string|email|max:255|unique:users,email,' . auth()->user()->id,
                'phone'             =>   'nullable|string|regex:/(01)[0-9]{9}/|unique:users,phone,' . auth()->user()->id,
                'description'       =>   'nullable|string|max:1500|min:10',
                'governorates'      =>   'nullable|string',
                'court_name'        =>   'nullable|string',
                'profile_image'     =>   'nullable|mimes:jpg,png',
            ], $messages);
        }
        else
        {
            $data = $request->validate([
                'first_name'        =>   'nullable|string|max:255',
                'last_name'         =>   'nullable|string|max:255',
                'email'             =>   'nullable|string|email|max:255|unique:users,email,' . auth()->user()->id,
                'phone'             =>   'nullable|string|regex:/(01)[0-9]{9}/|unique:users,phone,' . auth()->user()->id,
                'governorates'      =>   'nullable|string',
                'profile_image'     =>   'nullable|mimes:jpg,png',
            ], $messages);
        }


        $userData = auth()->user();

        if($userData->userable_type == 'App\Models\Lawyer')
        {
            $lawyer = Lawyer::where('id', $userData->userable->id)->first();
            if($request->file('profile_image') != null){
                $lawyer->setProfileImageAttribute($request->file('profile_image'));
            }

            // All posted data except token and id
            $data = request()->except(['_token','id']);

            // Remove empty array values from the data
            $result = array_filter($data);

            // lawyer
            $lawyer->update($result);
            // user
            $userData->update($result);
        }
        else
        {
            $client = Client::where('id', $userData->userable_id)->first();
            if($request->file('profile_image') != null){
                $client->setProfileImageAttribute($request->file('profile_image'));
            }

            // All posted data except token and id
            $data = request()->except(['_token','id']);

            // Remove empty array values from the data
            $result = array_filter($data);

            // client
            $client->update($result);
            // user
            $userData->update($result);
        }
        
        $message = "تم تحديث البيانات بنجاح";
        Flash::success($message);
        return \Redirect::back()->withInput();
    }

    // public function post_login(Request $request)
    // {
    //     $Emailrules    = $this->getLoginRuleEmail();
    //     $Phonerules    = $this->getLoginRulePhone();
    //     $messages = $this->getMessages();

    //     $logins = $request->credentials;
        
    //     if(is_numeric($logins)){
    //         $cred = Validator::make($request->all(), ['credentials' => 'required'], $messages);

    //         if ($cred->fails()) {
    //             $message = $cred->errors()->first();
    //             return \Redirect::back()->withErrors($message);
    //         }

    //         $phoneexist = Validator::make($request->all(), ['credentials' => 'exists:users,phone'], $messages);

    //         if ($phoneexist->fails()) {
    //             $message = $phoneexist->errors()->first();
    //             return \Redirect::back()->withErrors($message);
    //         }
    //     } 
    //     elseif (filter_var($logins, FILTER_VALIDATE_EMAIL)) {
    //         $cred = Validator::make($request->all(), ['credentials' => 'required'], $messages);

    //         if ($cred->fails()) {
    //             $message = $cred->errors()->first();
    //             return \Redirect::back()->withErrors($message);
    //         }
            
    //         $mailexist = Validator::make($request->all(), ['credentials' => 'exists:users,email'], $messages);

    //         if ($mailexist->fails()) {
    //             $message = $mailexist->errors()->first();
    //             return \Redirect::back()->withErrors($message);
    //         }
            
    //     }

    //     $pass = Validator::make($request->all(), ['password' => 'required'], $messages);

    //     if ($pass->fails()) {
    //         $message = $pass->errors()->first();
    //         return \Redirect::back()->withErrors($message);
    //     }

        
    //     // $remember_me = $request->has('remember_me') ? true : false; 
        
    //     if (Auth::attempt(['email' => $request->credentials, 'password' => $request->password])) {
    //         $user = User::where('email', $request->credentials)->first();
    //     } 

    //     elseif (Auth::attempt(['phone' => $request->credentials,'password' => $request->password])) {
    //         $user = User::where('phone', $request->credentials)->first();
    //     } 

    //     else {
    //         $message = __('messages-old.verify_password');
    //         return \Redirect::back()->withErrors($message);
    //     }

    //     return $user;

    //     if($user->userable_type == 'App\Models\Lawyer')
    //     {
    //         session()->flash('success', 'مرحبا بك');
    //         return redirect()->route('lawyer.dashboard')
    //         ->withInput();
    //     }
    //     else
    //     {
    //         session()->flash('success', 'مرحبا بك');
    //         return redirect()->route('client.dashboard')
    //         ->withInput();
    //     }

    // }

    // public function client_register(Request $request)
    // {
            
    //     $messages = $this->getMessages();

    //     $data = $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'phone' => ['required', 'string', 'regex:/(01)[0-9]{9}/'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'governorate' => ['required', 'string'],
    //         'accept_terms' => ['required'],
    //     ], $messages);


    //     DB::beginTransaction();

    //     $client = Client::create($data);

    //     $user = User::create($data);

    //     if($request->accept_terms == 'yes')
    //     {
    //         $user->accept_terms += 1;
    //     }

    //     $user->save();

    //     DB::commit();

    //     // \Auth::login($user, true);

    //     // return \Redirect::route('client.dashboard')->withInput();

    //     return redirect(route('client.dashboard'));

    // }

    // public function lawyer_register(Request $request)
    // {

    //     $messages = $this->getMessages();

    //     $data = $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'phone' => ['required', 'string', 'regex:/(01)[0-9]{9}/'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'governorate' => ['required', 'string'],
    //         'court_name' => ['required', 'string'],
    //         'id_photo' => ['required', 'mimes:jpg,png'],
    //         'accept_terms' => ['required'],
    //     ], $messages);
        

    //     DB::beginTransaction();
    //     $lawyer = Lawyer::create($request->all());
    //     // set status -> inactive
    //     $lawyer->status = 0; 
    //     $lawyer->update([
    //         'id_photo' => $lawyer->setIdFileAttribute($request->file('id_photo'))
    //     ]);
    //     $user = User::create([
    //         'first_name' => $request['first_name'],
    //         'last_name' => $request['last_name'],
    //         'phone' => $request['phone'],
    //         'email' => $request['email'],
    //         'password' => $request['password'],
    //         'userable_id' => $lawyer->id,
    //         'userable_type' => 'App\Models\Lawyer',
    //     ]);
            
    //     if($request->accept_terms == 'yes')
    //     {
    //         $user->accept_terms += 1;
    //     }
    //     $user->save();
    //     DB::commit();
    
    //     \Auth::login($user, true);

    //     Mail::to($user->email)->send(new NotifyMail($user, 'emails.EmailVerified', 'Under Review'));
    
    //     session()->flash('success', 'تم تسجيل البيانات بنجاح, مرحبا بك');
    //     return \Redirect::route('lawyer.dashboard')->withInput();
    // }

    // public function register()
    // {
    //     return view('auth.sign-up');
    // }

    // public function login()
    // {
    //     if(Auth::check())
    //     {
    //         return \Redirect::back();
    //     }
    //     else
    //     {
    //         return view('auth.login');
    //     } 
    // }


    // public function email_sent(Request $request)
    // {
    //     $input = $request->only('email');

    //     $messages = $this->getMessages();


    //     $mail = Validator::make($input, ['email' => "required"], $messages);

    //     if ($mail->fails()) {
    //         return \Redirect::back()->withErrors($mail->errors()->first());
    //     }

    //     $mailval = Validator::make($input,['email' => "email"], $messages);

    //     if ($mailval->fails()) {
    //         return \Redirect::back()->withErrors($mailval->errors()->first());
    //     }

    //     $mailexist = Validator::make($input, ['email' => "exists:users,email"], $messages);

    //     if ($mailexist->fails()) {
    //         return \Redirect::back()->withErrors($mailexist->errors()->first());
    //     }

    //     $response =  Password::sendResetLink($input);

    //     if($response == Password::RESET_LINK_SENT){
    //             $message = __('messages.reset_password');
    //     }else{
    //             $message = __('messages.reset_password_fail');
    //             return \Redirect::back()->withErrors($message);
    //     }
    //         $response = ['message' => $message];
            
    //     session()->flash('success', $message);
    //     return \Redirect::back()->withInput();
    // }

    public function getMessages()
    {
        return $messages = [
            'phone.required'      => "من فضلك أدخل الهاتف",
            'phone.unique'        => "هذا الهاتف موجود مسبقًا",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'phone.digits'        => "رقم الهاتف ناقصا",
            'phone.regex'        => "رقم الهاتف ليس على صورته الصحيحة، أعد المحاولة",
            'first_name.required'       => "من فضلك أدخل الاسم",   
            'last_name.required'       => "من فضلك أدخل الاسم",     
            'email.required'      => "من فضلك أدخل البريد الالكتروني",
            'email.unique'        => "هذا الحساب موجود مسبقًا",
            'email.exists'        => "هذا الحساب غير موجود",
            'email.email'         => "الحساب الذي أدخلته ليس صالحا",
            'governorates.required' => "من فضلك أدخل المحافظة",
            'court_name.required' => "من فضلك أدخل اسم المحكمة التابع لها",
            'password.required'   => "من فضلك أدخل كلمة السر",
            'password.confirmed'  => "كلمة السر التأكيدية ليست صحيحة، أعد المحاولة",
            'password.regex'      => "يجب ان تتضمن كلمة السر علي الاقل حرف كبير وحرف صغير ورقم ورمز",
            'accept_terms.required' => "من فضلك لم توافق على شروط الخصوصية بعد",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'credentials.exists'  => "بياناتك غير صحيحة أعد المحاولة",
            'credentials.required'=> "من فضلك أدخل البريد الالكتروني أو الهاتف المسجل",
            'id_photo.required'   => "من فضلك أدخل صورة الكارنيه",
            'id_photo.mimes'      => "الصورة المدخلة ليست صالحة",
            'profile_image.mimes' => "الصورة المدخلة ليست صالحة",
            'confirmed' => 'كلمة السر التأكيدية ليست صحيحة',
            'email' => ' البريد الالكتروني يجب أن يكون صالحا',
            'file' => 'ال :attribute يجب أن يكون ملفا',
            'image' => 'ال :attribute يجب أن تكون صورة',
            'required' => 'ال :attribute مطلوب',
            'same' => 'ال :attribute و :other يجب أن يتوافقا',
            'unique' => 'مستخدم بالفعل',
            'exists' => 'عفوا البيانات غير مسجلة',
            'min' => [
                'string' => 'ما أدخلته غير كافي ',
            ],
            'old_password.required' => 'من فضلك أدخل كلمة المرور الخاصة بك',
            'new_password.required' => 'من فضلك أدخل كلمة المرور الجديدة',
            'new_password.string' => 'يجب أن تتكون كلمة المرور من حروف وأرقام',
            'new_password.min' => 'يجب ألا تقل كلمة المرور عن 8 أحرف',
            'new_password.different' => 'من فضلك أدخل كلمة مرور مختلفة عن السابقة',
            'new_password.confirmed' => 'من فضلك أعد تأكيد كلمة المرور الجديدة',
            'new_password_confirmation.required' => 'من فضلك أعد تأكيد كلمة المرور الجديدة',
            'new_password_confirmation.same' => 'كلمة المرور التأكيدية ليست صحيحة، حاول مجددًا',
            'description.min' => 'يجب ألا تقل النبذة عن 10 أحرف',
            'description.max' => 'يجب ألا تزيد النبذة عن 1500 حرف',

        ];
    }

    public function getLoginRuleEmail()
    {
        return $rules = [
            'credentials'    => 'required|exists:users,email',
            'password'       => 'required',
        ];
    }

    public function getLoginRulePhone()
    {
        return $rules = [
            'credentials'    => 'required|exists:users,phone',
            'password'       => 'required',
        ];
    }
}
