<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    /**
     * Amount of groups to generate
     * @var int
     */
    private int $groupsAmount = 5;

    /**
     * Amount of users to generate
     * @var int
     */
    private int $usersAmount = 20;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            QuizSeeder::class,
            RewardsSeeder::class,
            GameTranslationSeeder::class,
        ]);

        // Get games
        $games = Game::get(['id'])->toArray();

        // Generate groups
        $groups = Group::factory($this->groupsAmount)
            ->create();

        // Generate users
        $users = User::factory($this->usersAmount)
            ->create();

        // Generate group members and scores
        foreach ($users as &$user) {
            $user_score_is_in_group = fake()->boolean(40);
            $random_group = rand(0, $this->groupsAmount - 1);
            $score_number = rand(0, 5);

            DB::table('group_members')->insert([
                'user_id' => $user->id,
                'group_id' => $groups[$random_group]->id
            ]);

            for ($i = 0; $i < $score_number; $i++) {
                DB::table('user_scores')->insert([
                    'user_id' => $user->id,
                    'group_id' => $user_score_is_in_group ? $groups[$random_group]->id : null,
                    'score' => rand(1, 1000),
                    'started_at' => fake()->dateTime(),
                    'finished_at' => fake()->dateTime(),
                    'game_id' => $games[array_rand($games)]['id']
                ]);
            }
        }
    }
}
