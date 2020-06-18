<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Found;

class SearchDropdownFound extends Component
{
    public $searchFound = "";

    public function render()
    {
        $searchResultsFound = Found::where('description', 'LIKE', '%'. $this->searchFound. '%')
            ->orWhere('name', 'LIKE', '%'. $this->searchFound. '%')
            ->orWhere('id', '=', $this->searchFound)
            ->orderBy('id', 'DESC')
            ->paginate(12);

        return view('livewire.search-dropdown-found', compact('searchResultsFound'));
    }
}
