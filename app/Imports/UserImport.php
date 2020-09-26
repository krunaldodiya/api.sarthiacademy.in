<?php

namespace App\Imports;

use App\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id'                            => $row['id'],
            'email'                         => $row['email'],
            'email_verified_at'             => $row['email_verified_at'],
            'mobile'                        => $row['mobile'],
            'mobile_verified_at'            => $row['mobile_verified_at'],
            'username'                      => $row['username'],
            'password'                      => $row['password'],
            'name'                          => $row['name'],
            'dob'                           => $row['dob'],
            'gender'                        => $row['gender'],
            'avatar'                        => $row['avatar'],
            'city'                          => $row['city'],
            'country_id'                    => $row['country_id'],
            'unique_id'                     => $row['unique_id'],
            'account_status'                => $row['account_status'],
            'status'                        => $row['status'],
            'remember_token'                => $row['remember_token'],
            'created_at'                    => $row['created_at'],
            'updated_at'                    => $row['updated_at'],
        ]);
    }
}
