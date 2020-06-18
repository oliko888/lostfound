<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Lost;

class SearchDropdownLost extends Component
{
    public $searchLost = "";

    public function render()
    {
        $searchResultsLost = Lost::where('description', 'LIKE', '%'. $this->searchLost. '%')
            ->orWhere('name', 'LIKE', '%'. $this->searchLost. '%')
            ->orWhere('id', '=', $this->searchLost)
            ->orderBy('id', 'DESC')
            ->paginate(12);

        return view('livewire.search-dropdown-lost', compact('searchResultsLost'));
    }
}
