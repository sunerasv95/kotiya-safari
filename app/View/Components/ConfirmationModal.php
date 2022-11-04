<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public $heading;
    public $message;
    public $action;
    public $actionText;
    public $modalId;

    public function __construct(
        $heading,
        $message,
        $action,
        $actionText,
        $modalId
    )
    {
        $this->heading      = $heading;
        $this->message      = $message;
        $this->action       = $action;
        $this->actionText   = $actionText;
        $this->modalId      = $modalId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.confirmation-modal');
    }
}
