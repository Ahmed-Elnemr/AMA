<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\TopRanked;
use Livewire\WithPagination;
use App\Models\BusinessInformation;

class CreateTopRankedLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public $legal_name, $logo_media_id, $user_id,$businessId,$businessinfo_id;


    public function addRank(int $id)
    {
        $business =   BusinessInformation::where('id', $id)->first();
        $this->businessId= $business->id ;
         $this->legal_name= $business->legal_name ;
         $this->logo_media_id = $business->logo_media_id ;
         $this->user_id =$business->user_id;
         $this->businessinfo_id=$business->id;
        $this->creteTopRanked();
    }
    public function creteTopRanked(){
        TopRanked::create([
            'user_id'=>$this->user_id,
            'businessinfo_id'=>$this->businessinfo_id,
            'media_id'=>$this->logo_media_id,
        ]);
        session()->flash('message', 'Bussiness Added to Top Ranked Successfully');
    }

    public function render()
    {
        $topRankeds = BusinessInformation::where('legal_name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $allRankeds=TopRanked::get();


        return view('livewire.admin.create-top-ranked-livewire', [
            'topRankeds' => $topRankeds,
            'allRankeds'=>$allRankeds,
        ]);
    }
}
