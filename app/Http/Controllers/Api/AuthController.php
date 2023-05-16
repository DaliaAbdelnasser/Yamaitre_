<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lawyer;
use App\Models\Client;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Mail;
use File;
use App\Mail\NotifyMail;
use App\Models\Balance;

class AuthController extends Controller
{
    public function response($user)
    {
        $token = $user->createToken(str()->random(40))->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function lawyer_register(Request $request)
    {
        try {
            $rules    = $this->getRules();
            $messages = $this->getMessages();

            $first_name = Validator::make($request->all(), ['first_name' => 'required'], $messages);
    
            if ($first_name->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noFirstName',
                    'errors'=>$first_name->errors()->first(),
                ], 422);
            }

            $last_name = Validator::make($request->all(), ['last_name' => 'required'], $messages);
    
            if ($last_name->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noLastNameAdded',
                    'errors'=>$last_name->errors()->first(),
                ], 422);
            }

            $phone = Validator::make($request->all(), ['phone' => 'required'], $messages);
    
            if ($phone->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noPhoneAdded',
                    'errors'=>$phone->errors()->first(),
                ], 422);
            }
                    // phone
            $num = Validator::make($request->all(), ['phone' => 'numeric'], $messages);

            if ($num->fails()) {
                return response([
                    'type' => 'notNumeric',
                    'errors'=>$num->errors()->first(),
                ], 422);
            }

            $digit = Validator::make($request->all(), ['phone' => 'digits:11'], $messages);

            if ($digit->fails()) {
                return response([
                    'type' => 'exceededMaxDigitsNumber',
                    'errors'=>$digit->errors()->first(),
                ], 422);
            }

            $regex = Validator::make($request->all(), ['phone' => 'regex:/(01)[0-9]{9}/'], $messages);

            if ($regex->fails()) {
                return response([
                    'type' => 'incorrectPhoneFormat',
                    'errors'=>$regex->errors()->first(),
                ], 422);
            }

            $phoneunique = Validator::make($request->all(), ['phone' => 'unique:users,phone'], $messages);
    
            if ($phoneunique->fails()) {
                return response([
                    'success' => false,
                    'type' => 'alreadyPhoneUsedBefore',
                    'errors'=>$phoneunique->errors()->first(),
                ], 422);
            }

            $mailunique = Validator::make($request->all(), ['email' => 'unique:users,email'], $messages);
    
            if ($mailunique->fails()) {
                return response([
                    'success' => false,
                    'type' => 'alreadyEmailUsedBefore',
                    'errors'=>$mailunique->errors()->first(),
                ], 422);
            }

            $mail = Validator::make($request->all(), ['email' => 'email'], $messages);
    
            if ($mail->fails()) {
                return response([
                    'success' => false,
                    'type' => 'notValidEmail',
                    'errors'=>$mail->errors()->first(),
                ], 422);
            }

            $mailreq = Validator::make($request->all(), ['email' => 'required'], $messages);
    
            if ($mailreq->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noEmailAdded',
                    'errors'=>$mailreq->errors()->first(),
                ], 422);
            }

            // court name
            $court = Validator::make($request->all(), ['court_name' => 'required'], $messages);

            if ($court->fails()) {
                return response([
                    'type' => 'noCourtNameAdded',
                    'errors'=>$court->errors()->first(),
                ], 422);
            }

            // governorates
            $gov = Validator::make($request->all(), ['governorates' => 'required'], $messages);

            if ($gov->fails()) {
                return response([
                    'type' => 'noGovernoratesAdded',
                    'errors'=>$gov->errors()->first(),
                ], 422);
            }

            // 
            $accept = Validator::make($request->all(), ['accept_terms' => 'required'], $messages);

            if ($accept->fails()) {
                return response([
                    'type' => 'notAcceptedYet',
                    'errors'=>$accept->errors()->first(),
                ], 422);
            }

            // id photo
            $idphoto = Validator::make($request->all(), ['id_photo' => 'required'], $messages);

            if ($idphoto->fails()) {
                return response([
                    'type' => 'noIdPhotoAdded',
                    'errors'=>$idphoto->errors()->first(),
                ], 422);
            }

            // id photo
            $photovalid = Validator::make($request->all(), ['id_photo' => 'mimes:jpg,png'], $messages);

            if ($photovalid->fails()) {
                return response([
                    'type' => 'notValidIdPhoto',
                    'errors'=>$photovalid->errors()->first(),
                ], 422);
            }

            // password
            $pass = Validator::make($request->all(), ['password' => 'required'], $messages);

            if ($pass->fails()) {
                return response([
                    'type' => 'noPasswordAdded',
                    'errors'=>$pass->errors()->first(),
                ], 422);
            }

            // password
            $conpass = Validator::make($request->all(), ['password' => 'confirmed'], $messages);

            if ($conpass->fails()) {
                return response([
                    'type' => 'incorrectPassConfirmation',
                    'errors'=>$conpass->errors()->first(),
                ], 422);
            }
            

            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => $request['password'],
                'userable_type' => 'App\Models\Lawyer',
            ]);

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
                $this->attributes['id_photo'] = $fileName;
                $lawyer->id_photo = $fileName;
            }
            
            $lawyer->save();
            
            if($request->accept_terms == 'yes')
            {
                $user->accept_terms += 1;
            }
            $user->userable_id = $user->id; 
            $user->save();

            $balance = new Balance(['user_id' => $user->id]);
            $user->balance()->save($balance);
        
            DB::commit();
    
            Mail::to($user->email)->send(new NotifyMail($user, 'emails.EmailVerified', 'Under Review', ''));
            $user = $user->with('userable')->find($user->id);
            return $this->response($user);
        } 
        catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 401);
        }
    }


    public function client_register(Request $request)
    {
        try {
            $rules    = $this->getRules();
            $messages = $this->getMessages();

            // $name = Validator::make($request->all(), ['name' => 'required'], $messages);
    
            // if ($name->fails()) {
            //     return response([
            //         'success' => false,
            //         'type' => 'noNameAdded',
            //         'errors'=>$name->errors()->first(),
            //     ], 422);
            // }

            $first_name = Validator::make($request->all(), ['first_name' => 'required'], $messages);
    
            if ($first_name->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noFirstName',
                    'errors'=>$first_name->errors()->first(),
                ], 422);
            }

            $last_name = Validator::make($request->all(), ['last_name' => 'required'], $messages);
    
            if ($last_name->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noLastNameAdded',
                    'errors'=>$last_name->errors()->first(),
                ], 422);
            }

            $phone = Validator::make($request->all(), ['phone' => 'required'], $messages);
    
            if ($phone->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noPhoneAdded',
                    'errors'=>$phone->errors()->first(),
                ], 422);
            }
                    // phone
            $num = Validator::make($request->all(), ['phone' => 'numeric'], $messages);

            if ($num->fails()) {
                return response([
                    'type' => 'notNumeric',
                    'errors'=>$num->errors()->first(),
                ], 422);
            }

            $digit = Validator::make($request->all(), ['phone' => 'digits:11'], $messages);

            if ($digit->fails()) {
                return response([
                    'type' => 'exceededMaxDigitsNumber',
                    'errors'=>$digit->errors()->first(),
                ], 422);
            }

            $regex = Validator::make($request->all(), ['phone' => 'regex:/(01)[0-9]{9}/'], $messages);

            if ($regex->fails()) {
                return response([
                    'type' => 'notCorrectPhoneFormat',
                    'errors'=>$regex->errors()->first(),
                ], 422);
            }

            $phoneunique = Validator::make($request->all(), ['phone' => 'unique:users,phone'], $messages);
    
            if ($phoneunique->fails()) {
                return response([
                    'success' => false,
                    'type' => 'alreadyPhoneUsedBefore',
                    'errors'=>$phoneunique->errors()->first(),
                ], 422);
            }

            $mailunique = Validator::make($request->all(), ['email' => 'unique:users,email'], $messages);
    
            if ($mailunique->fails()) {
                return response([
                    'success' => false,
                    'type' => 'alreadyEmailUsedBefore',
                    'errors'=>$mailunique->errors()->first(),
                ], 422);
            }

            $mail = Validator::make($request->all(), ['email' => 'email'], $messages);
    
            if ($mail->fails()) {
                return response([
                    'success' => false,
                    'type' => 'notValidEmail',
                    'errors'=>$mail->errors()->first(),
                ], 422);
            }

            $mailreq = Validator::make($request->all(), ['email' => 'required'], $messages);
    
            if ($mailreq->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noEmailAdded',
                    'errors'=>$mailreq->errors()->first(),
                ], 422);
            }

            // governorates
            $gov = Validator::make($request->all(), ['governorates' => 'required'], $messages);

            if ($gov->fails()) {
                return response([
                    'type' => 'noGovernoratesAdded',
                    'errors'=>$gov->errors()->first(),
                ], 422);
            }

            // 
            $accept = Validator::make($request->all(), ['accept_terms' => 'required'], $messages);

            if ($accept->fails()) {
                return response([
                    'type' => 'notAcceptedYet',
                    'errors'=>$accept->errors()->first(),
                ], 422);
            }


            // password
            $pass = Validator::make($request->all(), ['password' => 'required'], $messages);

            if ($pass->fails()) {
                return response([
                    'type' => 'noPasswordAdded',
                    'errors'=>$pass->errors()->first(),
                ], 422);
            }

            // password
            $conpass = Validator::make($request->all(), ['password' => 'confirmed'], $messages);

            if ($conpass->fails()) {
                return response([
                    'type' => 'incorrectPassConfirmation',
                    'errors'=>$conpass->errors()->first(),
                ], 422);
            }
            
            
            DB::beginTransaction();
            // user
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => $request['password'],
                'userable_type' => 'App\Models\Client',
            ]);

            // client
            $client = array(
                'governorates' => $request->governorates, 'id' => $user->id, 'profile_image' => 'profile_placeholder.png'
            );

            Client::insert($client);

            $user->userable_id = $user->id;
           
            if($request->accept_terms == 'yes')
            {
                $user->accept_terms += 1;
            }
            $user->save();

            $balance = new Balance(['user_id' => $user->id]);
            $user->balance()->save($balance);
            
            DB::commit();
            $user = $user->with('userable')->find($user->id);
            return $this->response($user);
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
    }

    
    // login by email or phone
    public function login(Request $request)
    {
        $Emailrules    = $this->getLoginRuleEmail();
        $Phonerules    = $this->getLoginRulePhone();
        $messages = $this->getMessages();

        $logins = $request->credentials;

        if(is_numeric($logins)){
            $cred = Validator::make($request->all(), ['credentials' => 'required'], $messages);

            if ($cred->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noCredntialsAdded',
                    'errors'=>$cred->errors()->first(),
                ], 422);
            }

            $phoneexist = Validator::make($request->all(), ['credentials' => 'exists:users,phone'], $messages);

            if ($phoneexist->fails()) {
                return response([
                    'success' => false,
                    'type' => 'userNotExist',
                    'errors'=>$phoneexist->errors()->first(),
                ], 422);
            }
        } 
        elseif (filter_var($logins, FILTER_VALIDATE_EMAIL)) {
            $cred = Validator::make($request->all(), ['credentials' => 'required'], $messages);

            if ($cred->fails()) {
                return response([
                    'success' => false,
                    'type' => 'noCredntialsAdded',
                    'errors'=>$cred->errors()->first(),
                ], 422);
            }

            $mailexist = Validator::make($request->all(), ['credentials' => 'exists:users,email'], $messages);

            if ($mailexist->fails()) {
                return response([
                    'success' => false,
                    'type' => 'userNotExist',
                    'errors'=>$mailexist->errors()->first(),
                ], 422);
            }

        }

        $pass = Validator::make($request->all(), ['password' => 'required'], $messages);

        if ($pass->fails()) {
            return response([
                'success' => false,
                'type' => 'noPasswordAdded',
                'errors'=>$pass->errors()->first(),
            ], 422);
        }

        // $remember_me = $request->has('remember_me') ? true : false; 

        if (Auth::attempt(['email' => $request->credentials, 'password' => $request->password])) {
            $user = User::with('userable')->where('email', $request->credentials)->first();
        } 

        elseif (Auth::attempt(['phone' => $request->credentials,'password' => $request->password])) {
            $user = User::with('userable')->where('phone', $request->credentials)->first();
        } 

        else {
            return response()->json([
                'success' => false,
                'type' => 'incorrectUserPassword',
                'errors' => __('messages.verify_password'),
            ], 422);     
        }
       
        return $this->response($user);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message' => __('messages.log_out')]);
    }

    public function change_password(Request $request)
    {
      
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return response()->json([
                'success' => false,
                'type'    =>  'incorrectUserPassword',
                'message' => __('messages.same') ,
            ], 422);
        }

        $messages = $this->getMessages();
        $old = Validator::make($request->all(), ['old_password' => 'required'], $messages);

        if ($old->fails()) {
            return response([
                'success' => false,
                'type' => 'noOldPasswordAdded',
                'errors'=>$old->errors()->first(),
            ], 422);
        }

        $new = Validator::make($request->all(), ['new_password' => 'required'], $messages);

        if ($new->fails()) {
            return response([
                'success' => false,
                'type' => 'noNewPasswordAdded',
                'errors'=>$new->errors()->first(),
            ], 422);
        }

        $newcon = Validator::make($request->all(), ['new_password' => 'confirmed'], $messages);

        if ($newcon->fails()) {
            return response([
                'success' => false,
                'type' => 'incorrectNewPasswordConfirmation',
                'errors'=>$newcon->errors()->first(),
            ], 422);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response([
            'success' => true,
            'message' => __('messages.change_success'),
        ], 200);
        
    }

    public function forget_password(Request $request)
    {
        $input = $request->only('email');
        $messages = $this->getMessages();

        $mail = Validator::make($input, ['email' => "required"], $messages);

        if ($mail->fails()) {
            return response([
                'success' => false,
                'type' => 'noEmailAdded',
                'errors'=>$mail->errors()->first(),
            ], 422);
        }

        $mailval = Validator::make($input,['email' => "email"], $messages);

        if ($mailval->fails()) {
            return response([
                'success' => false,
                'type' => 'notValidEmail',
                'errors'=>$mailval->errors()->first(),
            ], 422);
        }

        $mailexist = Validator::make($input, ['email' => "exists:users,email"], $messages);

        if ($mailexist->fails()) {
            return response([
                'success' => false,
                'type' => 'userNotExist',
                'errors'=>$mailexist->errors()->first(),
            ], 422);
        }

        $response =  Password::sendResetLink($input);

        if($response == Password::RESET_LINK_SENT){
                $message = __('messages.reset_password');
        }else{
                $message = __('messages.reset_password_fail');
        }
            $response = ['message' => $message];
            
        return response($response, 200);
    }

    public function getMessages()
    {
        return $messages = [
            'phone.required'      => "من فضلك أدخل الهاتف",
            'phone.unique'        => "هذا الهاتف موجود مسبقًا",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'phone.digits'        => "رقم الهاتف ناقصا",
            'phone.regex'        => "رقم الهاتف ليس على صورته الصحيحة، أعد المحاولة",
            'name.required'       => "من فضلك أدخل الاسم",    
            'email.required'      => "من فضلك أدخل البريد الالكتروني",
            'email.unique'        => "هذا الحساب موجود مسبقًا",
            'email.exists'        => "هذا الحساب غير موجود",
            'email.email'         => "الحساب الذي أدخلته ليس صالحا",
            'governorates.required' => "من فضلك أدخل المحافظة",
            'court_name.required' => "من فضلك أدخل اسم المحكمة التابع لها",
            'password.required'   => "من فضلك أدخل كلمة السر",
            'password.confirmed'  => "كلمة السر التأكيدية ليست صحيحة، أعد المحاولة",
            'accept_terms.required' => "من فضلك لم توافق على شروط الخصوصية بعد",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'credentials.exists'  => "بياناتك غير صحيحة أعد المحاولة",
            'credentials.required'=> "من فضلك أدخل الحساب أو الهاتف",
        ];
    }


    protected function getRules()
    {
        return $rules = [
            'first_name'             => 'required',
            'last_name'             => 'required',
            'phone'            => 'required|numeric|unique:users,phone|digits:11|regex:/(01)[0-9]{9}/',
            'email'            => 'required|email|unique:users,email',
            'governorates'     => 'required',
            'profile_image'    => 'nullable|mimes:jpg,png',
            'id_photo'         => 'required|mimes:jpg,png',
            'password'         => 'required|confirmed',
            'accept_terms'     => 'required',
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
