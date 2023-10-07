<?php

use Illuminate\Support\Arr;
use TallStackUi\Facades\TallStackUi;

if (! function_exists('tallstackui_personalization')) {
    function tallstackui_personalization(string $personalization, array $customization): array
    {
        $personalization = TallStackUi::personalize($personalization)
            ->instance()
            ->toArray();

        return Arr::only(array_merge($customization, $personalization), array_keys($customization));
    }
}
