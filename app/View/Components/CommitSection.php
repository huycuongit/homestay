<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CommitSection extends Component
{
    public $arrSetups;
    public $commits;

    public function __construct($arrSetups, $commits)
    {
        $this->arrSetups = $arrSetups;
        $this->commits = $commits;
    }

    public function render()
    {
        return view('components.commit-section', [
            'arrSetups' => $this->arrSetups,
            'commits' => $this->commits,
        ]);
    }
}
