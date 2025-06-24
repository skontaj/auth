<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $output = new ConsoleOutput();
        $count = (int) $this->command->ask('How many entries do you want to create?', 1);

        $progress = new ProgressBar($output, $count);
        $progress->start();

        for ($i = 0; $i < $count; $i++) {
            $name = $this->command->ask("Enter the city name ($i):");
            $country = $this->command->ask("Enter the name of the country ($i):");
            $timezone = $this->command->ask("Enter time zone ($i) (npr. Europe/Sarajevo):");
            $temperature = (int) $this->command->ask("Enter the temperature. ($i) (-50 do 60):");

            // Validacija
            $validator = Validator::make([
                'name' => $name,
                'country' => $country,
                'timezone' => $timezone,
                'temperature' => $temperature,
            ], [
                'name' => 'required|string|max:255|unique:cities,name',
                'country' => 'required|string|max:255',
                'timezone' => [
                    'required', 'string', 'max:255',
                    'in:' . implode(',', timezone_identifiers_list())
                ],
                'temperature' => 'required|integer|min:-50|max:60',
            ]);

            if ($validator->fails()) {
                $this->command->error('The data is not valid.: ' . implode(', ', $validator->errors()->all()));
                $i--; // ponovi iteraciju
                continue;
            }

            DB::table('cities')->insert([
                'name' => $name,
                'country' => $country,
                'timezone' => $timezone,
                'temperature' => $temperature,
            ]);

            $progress->advance();
        }

        $progress->finish();
        $this->command->info("\n✅ Entry completed!");
    }
}
