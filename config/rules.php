<?php

use App\Models\Invitation;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Cratespace\Sentinel\Rules\PasswordRule;

return [
    /*
     * Password Input Validation Rules.
     */
    'password' => ['required', 'string', new PasswordRule(), 'confirmed'],

    /*
     * User Login Validation Rules.
     */
    'login' => [
        'email' => ['sometimes', 'string', 'email'],
        'password' => ['required', 'string'],
        'remember' => ['sometimes'],
    ],

    /*
     * User Registration Validation Rules.
     */
    'register' => [
        'name' => ['required', 'string', 'max:255'],
        'team' => ['required', 'string'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'phone' => ['sometimes', 'string', 'regex:/(0)[0-9]{9}/'],
        'password' => ['required', 'string', new PasswordRule(), 'confirmed'],
    ],

    /*
     * User Profile Information Validation Rules.
     */
    'update_profile' => [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email'],
        'phone' => ['sometimes', 'string', 'regex:/(0)[0-9]{9}/'],
        'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
    ],

    /*
     * Address Inputs Validation Rules.
     */
    'address' => [
        'line1' => ['required', 'string', 'max:255'],
        'line2' => ['sometimes', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'state' => ['required', 'string', 'max:255'],
        'country' => ['required', 'string', 'max:255'],
        'postal_code' => ['required', 'string', 'max:255'],
    ],

    /*
     * User Account Password Update Validation Rules.
     */
    'update_password' => [
        'current_password' => ['required', 'string'],
        'password' => [
            'required',
            'string',
            new PasswordRule(),
            'confirmed',
            'different:current_password',
        ],
    ],

    'team' => [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'email' => ['required', 'string', 'email'],
        'phone' => ['sometimes', 'string', 'regex:/(0)[0-9]{9}/'],
        'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
    ],

    'invitation' => [
        'email' => [
            'required',
            'email',
            Rule::unique(Invitation::class),
        ],
        'role' => ['required', 'exists:roles,id'],
    ],
];
