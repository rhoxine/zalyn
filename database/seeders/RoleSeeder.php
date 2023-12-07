<?php

namespace Database\Seeders;

use App\Models\Medhistory;
use App\Models\Questions;
use App\Models\Services;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);
        $adminUser = User::create([
            'name' => "Administrator",
            'email' => "admin@sample.com",
            'password' => Hash::make("123\$qweR"),
        ]);
        $User = User::create([
            'name' => "User",
            'email' => "user@sample.com",
            'password' => Hash::make("123\$qweR"),
        ]);

        $adminUser->assignRole($adminRole);
        $User->assignRole($userRole);

        $services = [
            [
                'service_name' => 'Tooth Restoration (Pasta)',
                'price' => '1000',
            ],
            [
                'service_name' => 'Tooth Whitening (Pampaputi ng ngipin)',
                'price' => '500',
            ],
            [
                'service_name' => 'Oral Prophylaxis (linis ng ngipin)',
                'price' => '250',
            ],
            [
                'service_name' => 'Veneers',
                'price' => '8000',
            ],
            [
                'service_name' => 'Jacket Crown',
                'price' => '6000',
            ],
            [
                'service_name' => 'Fixed Bridge',
                'price' => '2300',
            ],
            [
                'service_name' => 'Dentures',
                'price' => '10000',
            ],
            [
                'service_name' => 'Surgery (bunot)',
                'price' => '8000',
            ],
            [
                'service_name' => 'Root Canal Treatment',
                'price' => '8000',
            ],
        ];

        foreach ($services as $key => $value) {
            Services::create($value);
        }
        
        $questions = [
            [
                'question' => 'Are you currently taking any medications?'
            ],
            [
                'question' => 'Do you have any known alergies to medications and anesthesia?'
            ],
            [
                'question' => 'Are you pregnant?'
            ],
            [
                'question' => 'Do you have fever?'
            ],
            [
                'question' => 'Do you have any medical conditions such as diabetes or heart disease?'
            ],
            [
                'question' => 'Do you have any pain, sensitivity, or bleeding gums?'
            ],
        ];

        foreach ($questions as $key => $question) {
            Questions::create($question);
        }

        $questions = Questions::all();

        foreach ($questions as $key => $value) {
            $question_id = $value->id;
            $question = $value->question;

            $med = [
                'user_id' => $adminUser->id,
                'question_id' => $question_id,
            ];

            Medhistory::create($med);
        }

        foreach ($questions as $key => $value) {
            $question_id = $value->id;
            $question = $value->question;

            $med = [
                'user_id' => $User->id,
                'question_id' => $question_id,
            ];

            Medhistory::create($med);
        }


    }
}
