<?php

namespace App\Classes\Factories\GameTemplateData;

abstract class GameTemplateDataFactory {

    public static function getTemplateDataSetter(string $game): self|null {
        $classes = [
            'quiz' => QuizTemplateData::class,
        ];
        return isset($classes[$game]) ? new $classes[$game] : null;
    }

    /**
     * Add whatever value you want in child class to passed array to be used in template.
     * @param array $data
     * @return void
     */
    abstract public function addToTemplate(array &$data): void;
}
