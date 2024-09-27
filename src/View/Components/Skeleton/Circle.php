<?php

namespace TallStackUi\View\Components\Skeleton;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\TallStackUiComponent;

#[SoftPersonalization('skeleton.circle')]
class Circle extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public ?string $size = null,
    ) {

    }

    public function blade(): View
    {
        return view('tallstack-ui::components.skeleton.circle');
    }

    public function personalization(): array
    {
        return Arr::dot([
            
        ]);
    }
}
