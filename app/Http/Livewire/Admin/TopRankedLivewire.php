<?php

namespace App\Http\Livewire\Admin;

use App\Models\TopRanked;
use Livewire\Component;
// use Livewire\WithPagination;


class TopRankedLivewire extends Component
{

    // use WithPagination;

    // protected $paginationTheme = 'bootstrap';
    // public $search = '';


    public function deleterank(int $id){
        TopRanked::where('id', $id)->delete();
        session()->flash('message', 'Delete Added to Top Ranked Successfully');

    }
    public function render()
    {
        // $topRankeds = TopRanked::where('legal_name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $topRankeds = TopRanked::orderBy('id', 'DESC')->paginate(10);
        // dd($topRankeds);

        return view('livewire.admin.top-ranked-livewire',[
            'topRankeds'=>$topRankeds,
        ]);
    }
}
