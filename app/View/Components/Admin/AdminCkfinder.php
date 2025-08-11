<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminCkfinder extends Component
{
    public $value;
    public $title;
    public $key;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $value,
        $title,
        $key
    )
    {
        $this->value = $value;
        $this->title = $title;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-ckfinder');
    }
}
