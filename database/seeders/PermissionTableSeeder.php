<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'teacher_create',
            ],
            [
                'id'    => 18,
                'title' => 'teacher_show',
            ],
            [
                'id'    => 19,
                'title' => 'teacher_delete',
            ],
            [
                'id'    => 20,
                'title' => 'teacher_edit',
            ],
            [
                'id'    => 21,
                'title' => 'teacher_access',
            ],
            [
                'id'    => 22,
                'title' => 'student_create',
            ],
            [
                'id'    => 23,
                'title' => 'student_edit',
            ],
            [
                'id'    => 24,
                'title' => 'student_show',
            ],
            [
                'id'    => 25,
                'title' => 'student_delete',
            ],
            [
                'id'    => 26,
                'title' => 'student_access',
            ],
            [
                'id'    => 27,
                'title' => 'fee_salary_access',
            ],
            [
                'id'    => 28,
                'title' => 'fee_create',
            ],
            [
                'id'    => 29,
                'title' => 'fee_edit',
            ],
            [
                'id'    => 30,
                'title' => 'fee_show',
            ],
            [
                'id'    => 31,
                'title' => 'fee_delete',
            ],
            [
                'id'    => 32,
                'title' => 'fee_access',
            ],
            [
                'id'    => 33,
                'title' => 'salary_create',
            ],
            [
                'id'    => 34,
                'title' => 'salary_edit',
            ],
            [
                'id'    => 35,
                'title' => 'salary_delete',
            ],
            [
                'id'    => 36,
                'title' => 'salary_show',
            ],
            [
                'id'    => 37,
                'title' => 'salary_access',
            ],
            [
                'id'    => 38,
                'title' => 'fee_remainder_create',
            ],
            [
                'id'    => 39,
                'title' => 'fee_remainder_edit',
            ],
            [
                'id'    => 40,
                'title' => 'fee_remainder_show',
            ],
            [
                'id'    => 41,
                'title' => 'fee_remainder_delete',
            ],
            [
                'id'    => 42,
                'title' => 'fee_remainder_access',
            ],
            [
                'id'    => 43,
                'title' => 'attendence_access',
            ],
            [
                'id'    => 44,
                'title' => 'teacher_attendence_create',
            ],
            [
                'id'    => 45,
                'title' => 'teacher_attendence_edit',
            ],
            [
                'id'    => 46,
                'title' => 'teacher_attendence_show',
            ],
            [
                'id'    => 47,
                'title' => 'teacher_attendence_delete',
            ],
            [
                'id'    => 48,
                'title' => 'teacher_attendence_access',
            ],
            [
                'id'    => 49,
                'title' => 'student_attendence_create',
            ],
            [
                'id'    => 50,
                'title' => 'student_attendence_edit',
            ],
            [
                'id'    => 51,
                'title' => 'student_attendence_show',
            ],
            [
                'id'    => 52,
                'title' => 'student_attendence_delete',
            ],
            [
                'id'    => 53,
                'title' => 'student_attendence_access',
            ],
            [
                'id'    => 54,
                'title' => 'holiday_schedular_access',
            ],
            [
                'id'    => 55,
                'title' => 'holiday_schedular_create',
            ],
            [
                'id'    => 56,
                'title' => 'holiday_schedular_edit',
            ],
            [
                'id'    => 57,
                'title' => 'holiday_schedular_show',
            ],
            [
                'id'    => 58,
                'title' => 'holiday_schedular_delete',
            ],
        ];

        Permission::insert($permissions);
    }
}
