<?php

namespace App\Http\Livewire\Admin;

use App\Models\Story;
use Livewire\Component;
use Livewire\WithPagination;

class StoryLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $soryId;

    public function deleteStory(int $story_id){
        $this->resetInput();
        $this->soryId=$story_id;

    }


   public function destroyStory(){
    $story=Story::find($this->soryId);
    $story->delete();
    $this->resetInput();
    $this->dispatchBrowserEvent('close-modal');
   }

   public function closeModal()
   {
       $this->resetInput();
   }

   public function resetInput()
   {
       $this->soryId = '';
   }

    public function render()
    {

        $stories=Story::orderBy('id', 'DESC')->paginate(12);
        // dd($stories);
        return view('livewire.admin.story-livewire',[
            'stories'=>$stories,
        ]);
    }
}
