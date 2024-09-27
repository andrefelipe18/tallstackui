<?php

namespace TallStackUi\View\Components\Skeleton;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\TallStackUiComponent;

#[SoftPersonalization('skeleton.image')]
class Image extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public ?string $height = null,
        public ?string $width = null,
    ) {

    }

    public function blade(): View
    {
        return view('tallstack-ui::components.skeleton.image');
    }

    public function personalization(): array
    {
        return Arr::dot([
            
        ]);
    }
}
