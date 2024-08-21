<?php

use TallStackUi\Foundation\Actions\AbstractInteraction;
use TallStackUi\Foundation\Actions\Banner;
use TallStackUi\Foundation\Actions\Dialog;
use TallStackUi\Foundation\Actions\Toast;

test('class should be abstract')
    ->expect(AbstractInteraction::class)
    ->toBeAbstract();

test('implements abstraction action class')
    ->expect([Dialog::class, Toast::class, Banner::class])
    ->toExtend(AbstractInteraction::class);

test('abstract action class has method', function (string $method) {
    expect(AbstractInteraction::class)->toHaveMethod($method);
})->with([
    '__construct',
    'error',
    'info',
    'question',
    'success',
    'warning',
    'wireable',
    'event',
    'messages',
]);
