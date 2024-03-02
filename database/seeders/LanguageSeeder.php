<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder {

    /**
     * Languages to create
     * @var string[]
     */
    private array $languages = ['FR', 'EN'];

    /**
     * Create languages
     */
    public function run(): void
    {
        foreach ($this->languages as $language) {
            Language::updateOrCreate(['code' => $language], ['code' => $language]);
        }
        // Create one fake language
        Language::factory(1)->create();
    }
}
