<?php

namespace App\Exports;

use App\User;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id',
            'email',
            'email_verified_at',
            'mobile',
            'mobile_verified_at',
            'username',
            'password',
            'name',
            'dob',
            'gender',
            'avatar',
            'city',
            'country_id',
            'unique_id',
            'account_status',
            'status',
            'remember_token',
            'created_at',
            'updated_at',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
