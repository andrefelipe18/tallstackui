@php($personalize = tallstackui_personalization('badge', $personalization()))

<span {{ $attributes->class([
        'rounded-md' => !$round && !$square,
        'rounded-full' => $round,
        $personalize['wrapper.class'],
        $personalize['wrapper.sizes.' . $size],
        $colors['wrapper.color'],
    ]) }}>
    @if ($icon && $position == 'left')
        <x-icon :$icon @class([
            'mr-1' => $position === 'left',
            $personalize['icon'],
            $colors['icon.color'],
        ]) />
    @endif
    {{ $text ?? $slot }}
    @if ($icon && $position == 'right')
        <x-icon :$icon @class([
            'ml-1' => $position === 'right',
            $personalize['icon'],
            $colors['icon.color'],
        ]) />
    @endif
</span>