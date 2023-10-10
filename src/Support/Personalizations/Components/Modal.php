<?php

namespace TallStackUi\Support\Personalizations\Components;

use TallStackUi\Support\Personalizations\Contracts\Personalizable;
use TallStackUi\Support\Personalizations\PersonalizationResource;
use TallStackUi\View\Components\Modal as Component;

class Modal extends PersonalizationResource implements Personalizable
{
    protected function component(): string
    {
        return Component::class;
    }
}