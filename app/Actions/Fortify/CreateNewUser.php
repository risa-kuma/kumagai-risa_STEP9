<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        // 1. バリデーションに name_kanji と name_kana を追加
        Validator::make($input, [
            'name'       => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255'],
            'name_kana'  => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        // 2. User::create 時にも各項目を渡すように変更
        return User::create([
            'name'       => $input['name'],
            'name_kanji' => $input['name_kanji'],
            'name_kana'  => $input['name_kana'],
            'email'      => $input['email'],
            'password'   => Hash::make($input['password']),
        ]);
    }
}