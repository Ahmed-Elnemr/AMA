<?php

namespace App\Http\Livewire\Admin;

use App\Models\Answer;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class QuetionLivewire extends Component
{


    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $quId;

    public function deleteQu(int $qu_id){
        $this->resetInput();
        $this->quId=$qu_id;

    }


   public function destroyQu(){
    $qu=Question::find($this->quId);
    $qu->delete();
    $this->resetInput();
    $this->dispatchBrowserEvent('close-modal');
   }

   public function closeModal()
   {
       $this->resetInput();
   }

   public function resetInput()
   {
       $this->quId = '';
   }
    public function render()
    {



        $questions=Question::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.quetion-livewire',[
            'questions'=>$questions,
        ]);
    }
}
