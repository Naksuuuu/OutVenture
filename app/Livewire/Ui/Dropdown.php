<?php

namespace App\Livewire\Ui;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class Dropdown extends Component
{
    #[Modelable]
    public $value = '';

    public array $options = [];

    public string $width = 'w-full sm:w-40';

    public ?string $defaultLabel = null;

    public function mount($value = '', array $options = [], string $width = 'w-full sm:w-40', ?string $defaultLabel = null): void
    {
        $this->value = $value;
        $this->options = $options;
        $this->width = $width;
        $this->defaultLabel = $defaultLabel;
    }

    public function setValue($newValue): void
    {
        $this->value = $newValue;
    }

    public function render()
    {
        return view('livewire.ui.dropdown');
    }
}
