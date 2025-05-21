<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination extends Component
{
    public $paginator;
    public $entityName;

    /**
     * Create a new component instance.
     *
     * @param  \Illuminate\Pagination\LengthAwarePaginator  $paginator
     * @param  string  $entityName
     * @return void
     */
    public function __construct(LengthAwarePaginator $paginator, $entityName = 'items')
    {
        $this->paginator = $paginator;
        $this->entityName = $entityName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}