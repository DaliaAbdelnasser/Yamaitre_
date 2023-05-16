<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{


    public function update_profile(Request $request)
    {
        $messages = $this->getMessages();
        $rules = $this->getUpdateRules();

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
 
         $exist = Validator::make($request->all(), ['phone' => 'unique:users,phone,' . auth()->user()->id,], $messages);
 
         if ($exist->fails()) {
             return response([
                 'type' => 'alreadyPhoneUsedBefore',
                 'errors'=>$exist->errors()->first(),
             ], 422);
         }
 
         // email
         $mail = Validator::make($request->all(), ['email' => 'email'], $messages);
 
         if ($mail->fails()) {
             return response([
                 'type' => 'notValidEmail',
                 'errors'=>$mail->errors()->first(),
             ], 422);
         }
 
         $mailexist = Validator::make($request->all(), ['email' => 'unique:users,email,' . auth()->user()->id,], $messages);
 
         if ($mailexist->fails()) {
             return response([
                 'type' => 'alreadyEmailUsedBefore',
                 'errors'=>$mailexist->errors()->first(),
             ], 422);
         }
 
        
 
         // governorates
         $gov = Validator::make($request->all(), ['governorates' => 'string'], $messages);
 
         if ($gov->fails()) {
             return response([
                 'type' => 'notValidGovernorates',
                 'errors'=>$gov->errors()->first(),
             ], 422);
         }
 
 
         // profile image
         $profile = Validator::make($request->all(), ['profile_image' => 'mimes:jpg,png'], $messages);
 
         if ($profile->fails()) {
             return response([
                 'type' => 'notValidProfileImage',
                 'errors'=>$profile->errors()->first(),
             ], 422);
         }
 

        $userData = auth()->user();

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
        
        $userable = $userData->userable;
        


        return response([
            'message' => __('messages.update_profile'),
            'user'   => $userData,
            
        ], 200);
    }



    public function getUpdateRules()
    {
        return $rules = [
            'first_name'    => 'nullable',
            'last_name'     => 'nullable',
            'phone'         => 'nullable|numeric|unique:users,phone|digits:11|regex:/(01)[0-9]{9}/',
            'email'         => 'nullable|email|unique:users,email',
            'governorates'  => 'nullable|string',
            'profile_image' => 'nullable|mimes:jpg,png'
        ];
    }

    public function getMessages()
    {
        return $messages = [
            'phone.required'      => "من فضلك أدخل الهاتف",
            'phone.unique'        => "هذا الهاتف موجود مسبقًا",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'phone.digits'        => "رقم الهاتف ناقصا",
            'phone.regex'        => "رقم الهاتف ليس على صورته الصحيحة، أعد المحاولة",
            // 'name.required'       => "من فضلك أدخل الاسم",    
            'email.required'      => "من فضلك أدخل البريد الالكتروني",
            'email.unique'        => "هذا الحساب موجود مسبقًا",
            'email.email'         => "الحساب الذي أدخلته ليس صالحا",
            'governorates.required' => "من فضلك أدخل المحافظة",
            'governorates.string' => "من فضلك أدخل حروفا",
            'password.required'   => "من فضلك أدخل كلمة السر",
            'password.confirmed'  => "كلمة السر التأكيدية ليست صحيحة، أعد المحاولة",
            'accept_terms.required' => "مطلوب",
            'phone.numeric'       => "الهاتف يجب أن يتكون من أرقام",
            'credentials.exists'  => "بياناتك غير صحيحة أعد المحاولة",
            'credentials.required'=> "من فضلك أدخل الحساب أو الهاتف",
        ];
    }
}
