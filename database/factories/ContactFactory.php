<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = [];
        $users = User::query()->select('id')->get();
        foreach ($users as $key => $user){
            $userIds[] = $user->id;
        }
        $key = array_rand($userIds);
        return [
            'full_name' => fake()->name(),
            'birth_date' => now(),
            'user_id' => $userIds[$key],
        ];
    }
}
