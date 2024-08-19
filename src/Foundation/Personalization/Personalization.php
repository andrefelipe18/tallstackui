<?php

namespace TallStackUi\Foundation\Personalization;

use Closure;
use Exception;
use RuntimeException;
use TallStackUi\Contracts\Personalizable;
use TallStackUi\View\Components\Alert;
use TallStackUi\View\Components\Avatar;
use TallStackUi\View\Components\Badge;
use TallStackUi\View\Components\Banner;
use TallStackUi\View\Components\Boolean;
use TallStackUi\View\Components\Button\Button;
use TallStackUi\View\Components\Button\Circle;
use TallStackUi\View\Components\Card;
use TallStackUi\View\Components\Clipboard;
use TallStackUi\View\Components\Dropdown\Dropdown;
use TallStackUi\View\Components\Dropdown\Items as DropdownItems;
use TallStackUi\View\Components\Errors;
use TallStackUi\View\Components\Floating;
use TallStackUi\View\Components\Form\Checkbox;
use TallStackUi\View\Components\Form\Color;
use TallStackUi\View\Components\Form\Date;
use TallStackUi\View\Components\Form\Error;
use TallStackUi\View\Components\Form\Hint;
use TallStackUi\View\Components\Form\Input;
use TallStackUi\View\Components\Form\Label;
use TallStackUi\View\Components\Form\Number;
use TallStackUi\View\Components\Form\Password;
use TallStackUi\View\Components\Form\Pin;
use TallStackUi\View\Components\Form\Radio;
use TallStackUi\View\Components\Form\Range;
use TallStackUi\View\Components\Form\Tag;
use TallStackUi\View\Components\Form\Textarea;
use TallStackUi\View\Components\Form\Time;
use TallStackUi\View\Components\Form\Toggle;
use TallStackUi\View\Components\Form\Upload;
use TallStackUi\View\Components\Interaction\Dialog;
use TallStackUi\View\Components\Interaction\Toast;
use TallStackUi\View\Components\Link;
use TallStackUi\View\Components\Loading;
use TallStackUi\View\Components\Modal;
use TallStackUi\View\Components\Progress\Circle as ProgressCircle;
use TallStackUi\View\Components\Progress\Progress;
use TallStackUi\View\Components\Rating;
use TallStackUi\View\Components\Reaction;
use TallStackUi\View\Components\Select\Native as SelectNative;
use TallStackUi\View\Components\Select\Styled as SelectStyled;
use TallStackUi\View\Components\Slide;
use TallStackUi\View\Components\Stats;
use TallStackUi\View\Components\Step\Step;
use TallStackUi\View\Components\Tab\Tab;
use TallStackUi\View\Components\Table;
use TallStackUi\View\Components\ThemeSwitch;
use TallStackUi\View\Components\Tooltip;
use TallStackUi\View\Components\Wrapper\Input as InputWrapper;
use TallStackUi\View\Components\Wrapper\Radio as RadioWrapper;

/**
 * @internal This class is not meant to be used directly.
 */
class Personalization
{
    public function __construct(public ?string $component = null, public ?string $scope = null)
    {
        //
    }

    public function alert(): PersonalizationResources
    {
        return $this->component(Alert::class);
    }

    public function avatar(): PersonalizationResources
    {
        return $this->component(Avatar::class);
    }

    public function badge(): PersonalizationResources
    {
        return $this->component(Badge::class);
    }

    public function banner(): PersonalizationResources
    {
        return $this->component(Banner::class);
    }

    public function block(string|array $name, string|Closure|Personalizable|null $code = null): PersonalizationResources
    {
        return $this->instance()->block($name, $code);
    }

    public function boolean(): PersonalizationResources
    {
        return $this->component(Boolean::class);
    }

    public function button(?string $component = null): PersonalizationResources
    {
        $component ??= 'button';

        $class = match ($component) {
            'button' => Button::class,
            'circle' => Circle::class,
            default => $component,
        };

        return $this->component($class);
    }

    public function card(): PersonalizationResources
    {
        return $this->component(Card::class);
    }

    public function clipboard(): PersonalizationResources
    {
        return $this->component(Clipboard::class);
    }

    public function dialog(): PersonalizationResources
    {
        return $this->component(Dialog::class);
    }

    public function dropdown(?string $component = null): PersonalizationResources
    {
        $component ??= 'dropdown';

        $class = match ($component) {
            'dropdown' => Dropdown::class,
            'items' => DropdownItems::class,
            default => $component,
        };

        return $this->component($class);
    }

    public function errors(): PersonalizationResources
    {
        return $this->component(Errors::class);
    }

    public function floating(): PersonalizationResources
    {
        return $this->component(Floating::class);
    }

    public function form(?string $component = null): PersonalizationResources
    {
        $component ??= 'input';

        $class = match ($component) {
            'checkbox' => Checkbox::class,
            'color' => Color::class,
            'date' => Date::class,
            'error' => Error::class,
            'hint' => Hint::class,
            'input' => Input::class,
            'label' => Label::class,
            'number' => Number::class,
            'upload' => Upload::class,
            'password' => Password::class,
            'pin' => Pin::class,
            'range' => Range::class,
            'radio' => Radio::class,
            'tag' => Tag::class,
            'textarea' => Textarea::class,
            'time' => Time::class,
            'toggle' => Toggle::class,
            default => $component,
        };

        return $this->component($class);
    }

    public function instance(): PersonalizationResources
    {
        if (! $this->component) {
            throw new RuntimeException('No component has been set');
        }

        if (str_contains($this->component, 'tallstack-ui::personalizations')) {
            $this->component = str_replace('tallstack-ui::personalizations.', '', $this->component);
        }

        // This is necessary for cases where personalization aims to
        // manipulate components like form.number. We explode to get
        // the namespace - form, and the component - number.
        $parts = explode('.', $this->component);
        $main = $parts[0];
        $secondary = $parts[1] ?? null;

        if (! method_exists($this, $main)) {
            throw new RuntimeException("The method [{$main}] is not supported");
        }

        return call_user_func([$this, $main], $main === $secondary ?: $secondary);
    }

    public function link(): PersonalizationResources
    {
        return $this->component(Link::class);
    }

    public function loading(): PersonalizationResources
    {
        return $this->component(Loading::class);
    }

    public function modal(): PersonalizationResources
    {
        return $this->component(Modal::class);
    }

    public function progress(?string $component = null): PersonalizationResources
    {
        $component ??= 'progress';

        $class = match ($component) {
            'progress' => Progress::class,
            'circle' => ProgressCircle::class,
            default => $component,
        };

        return $this->component($class);
    }

    public function rating(): PersonalizationResources
    {
        return $this->component(Rating::class);
    }

    public function reaction(): PersonalizationResources
    {
        return $this->component(Reaction::class);
    }

    public function select(?string $component = null): PersonalizationResources
    {
        $component ??= 'native';

        $class = match ($component) {
            'native' => SelectNative::class,
            'styled' => SelectStyled::class,
            default => $component,
        };

        return $this->component($class);
    }

    public function slide(): PersonalizationResources
    {
        return $this->component(Slide::class);
    }

    public function stats(): PersonalizationResources
    {
        return $this->component(Stats::class);
    }

    public function step(): PersonalizationResources
    {
        return $this->component(Step::class);
    }

    public function tab(): PersonalizationResources
    {
        return $this->component(Tab::class);
    }

    public function table(): PersonalizationResources
    {
        return $this->component(Table::class);
    }

    public function themeSwitch(): PersonalizationResources
    {
        return $this->component(ThemeSwitch::class);
    }

    public function toast(): PersonalizationResources
    {
        return $this->component(Toast::class);
    }

    public function tooltip(): PersonalizationResources
    {
        return $this->component(Tooltip::class);
    }

    public function wrapper(?string $component = null): PersonalizationResources
    {
        $component ??= 'input';

        $class = match ($component) {
            'input' => InputWrapper::class,
            'radio' => RadioWrapper::class,
            default => $component,
        };

        return $this->component($class);
    }

    /**
     * Searches for the component from the list of all components using the customization attribute.
     *
     * @throws Exception
     */
    private function component(string $class): string|PersonalizationResources
    {
        $component = __ts_search_component($class);

        // This is the strategy adopted for scope personalization. We create a temporary
        // key in the Laravel container and instead of returning the same instance - which
        // would normally happen, as in v1, we return a new instance of PersonalizationResources.
        if (($scope = $this->scope) !== null) {
            $this->scope = null; // Resetting the scope to avoid infinite recursion.

            $instance = new PersonalizationResources($class, scope: $scope);

            app()->singleton(__ts_scope_container_key($component, $scope), fn () => $instance);

            return $instance;
        }

        return app($component);
    }
}
