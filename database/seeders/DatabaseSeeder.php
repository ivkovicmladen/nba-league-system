<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@nba.com',
            'password' => Hash::make('password'),
            'type' => 'admin',
        ]);

        // Create Teams
        $lakers = User::create([
            'first_name' => 'Los Angeles',
            'last_name' => 'Lakers',
            'email' => 'lakers@nba.com',
            'password' => Hash::make('password'),
            'date_of_birth' => '1947-01-01',
            'type' => 'team',
        ]);

        $celtics = User::create([
            'first_name' => 'Boston',
            'last_name' => 'Celtics',
            'email' => 'celtics@nba.com',
            'password' => Hash::make('password'),
            'date_of_birth' => '1946-06-06',
            'type' => 'team',
        ]);

        // Initialize team stats
        DB::table('team_stats')->insert([
            ['team_id' => $lakers->id, 'created_at' => now(), 'updated_at' => now()],
            ['team_id' => $celtics->id, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create Coaches
        $jackson = User::create([
            'first_name' => 'Phil',
            'last_name' => 'Jackson',
            'email' => 'pjackson@nba.com',
            'password' => Hash::make('password'),
            'date_of_birth' => '1945-09-17',
            'type' => 'person',
        ]);

        $popovich = User::create([
            'first_name' => 'Gregg',
            'last_name' => 'Popovich',
            'email' => 'popovich@nba.com',
            'password' => Hash::make('password'),
            'date_of_birth' => '1949-01-28',
            'type' => 'person',
        ]);

        // Create coach contracts
        DB::table('contracts')->insert([
            [
                'user_id' => $jackson->id,
                'date_from' => now(),
                'status' => 'Active',
                'salary' => 8000000,
                'role' => 'coach',
                'employer_id' => $lakers->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $popovich->id,
                'date_from' => now(),
                'status' => 'Active',
                'salary' => 11000000,
                'role' => 'coach',
                'employer_id' => $celtics->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('coach_stats')->insert([
            ['user_id' => $jackson->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $popovich->id, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Lakers Players
        $lakersPlayers = [
            ['LeBron', 'James', '1984-12-30', 'lebron@nba.com', 47000000],
            ['Anthony', 'Davis', '1993-03-11', 'adavis@nba.com', 40000000],
            ['Austin', 'Reaves', '1998-05-29', 'areaves@nba.com', 2000000],
            ['Rui', 'Hachimura', '1998-02-08', 'rhachimura@nba.com', 17000000],
            ['DAngelo', 'Russell', '1996-02-23', 'drussell@nba.com', 18000000],
            ['Jarred', 'Vanderbilt', '1999-04-03', 'jvanderbilt@nba.com', 10000000],
            ['Jaxson', 'Hayes', '2000-05-23', 'jhayes@nba.com', 2000000],
            ['Taurean', 'Prince', '1994-03-22', 'tprince@nba.com', 4000000],
            ['Gabe', 'Vincent', '1996-06-14', 'gvincent@nba.com', 11000000],
            ['Christian', 'Wood', '1995-09-27', 'cwood@nba.com', 3000000],
        ];

        foreach ($lakersPlayers as $playerData) {
            $player = User::create([
                'first_name' => $playerData[0],
                'last_name' => $playerData[1],
                'date_of_birth' => $playerData[2],
                'email' => $playerData[3],
                'password' => Hash::make('password'),
                'type' => 'person',
            ]);

            DB::table('contracts')->insert([
                'user_id' => $player->id,
                'date_from' => now(),
                'status' => 'Active',
                'salary' => $playerData[4],
                'role' => 'player',
                'employer_id' => $lakers->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('player_stats')->insert([
                'user_id' => $player->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Celtics Players
        $celticsPlayers = [
            ['Jayson', 'Tatum', '1998-03-03', 'jtatum@nba.com', 34000000],
            ['Jaylen', 'Brown', '1996-10-24', 'jbrown@nba.com', 28000000],
            ['Kristaps', 'Porzingis', '1995-08-02', 'kporzingis@nba.com', 36000000],
            ['Derrick', 'White', '1994-07-02', 'dwhite@nba.com', 18000000],
            ['Jrue', 'Holiday', '1990-06-12', 'jholiday@nba.com', 30000000],
            ['Al', 'Horford', '1986-06-03', 'ahorford@nba.com', 10000000],
            ['Sam', 'Hauser', '1997-12-08', 'shauser@nba.com', 2000000],
            ['Payton', 'Pritchard', '1998-01-28', 'ppritchard@nba.com', 4000000],
            ['Luke', 'Kornet', '1995-07-15', 'lkornet@nba.com', 2000000],
            ['Oshae', 'Brissett', '1998-06-20', 'obrissett@nba.com', 2000000],
        ];

        foreach ($celticsPlayers as $playerData) {
            $player = User::create([
                'first_name' => $playerData[0],
                'last_name' => $playerData[1],
                'date_of_birth' => $playerData[2],
                'email' => $playerData[3],
                'password' => Hash::make('password'),
                'type' => 'person',
            ]);

            DB::table('contracts')->insert([
                'user_id' => $player->id,
                'date_from' => now(),
                'status' => 'Active',
                'salary' => $playerData[4],
                'role' => 'player',
                'employer_id' => $celtics->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('player_stats')->insert([
                'user_id' => $player->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create Referees
        $referees = [
            ['Scott', 'Foster', '1970-01-01', 'sfoster@nba.com'],
            ['Tony', 'Brothers', '1968-01-01', 'tbrothers@nba.com'],
        ];

        foreach ($referees as $refData) {
            $referee = User::create([
                'first_name' => $refData[0],
                'last_name' => $refData[1],
                'date_of_birth' => $refData[2],
                'email' => $refData[3],
                'password' => Hash::make('password'),
                'type' => 'person',
            ]);

            DB::table('contracts')->insert([
                'user_id' => $referee->id,
                'date_from' => now(),
                'status' => 'Active',
                'salary' => 500000,
                'role' => 'referee',
                'employer_id' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('referee_stats')->insert([
                'user_id' => $referee->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✅ Database seeded successfully!\n";
        echo "- 1 Admin\n";
        echo "- 2 Teams (Lakers, Celtics)\n";
        echo "- 2 Coaches\n";
        echo "- 20 Players (10 per team)\n";
        echo "- 2 Referees\n";
        echo "\nAll passwords are: password\n";
    }
}