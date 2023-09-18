<?php

namespace App\Http\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;


class NotificationLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title ,$massages, $noti_id;
    public $search = '';
    protected function rules()
    {
        return [
            'title' => 'required',
            'massages' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveNoti()
    {

        $validatedData = $this->validate();
        Notification::create($validatedData);
        Notification::sendNotification($validatedData);
        session()->flash('message','Notification Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editNoti(int $noti_id)
    {
        $noti = Notification::find($noti_id);
        if($noti){

            $this->noti_id = $noti->id;
            $this->title = $noti->title;
            $this->massages = $noti->massages;
        }else{
            return redirect()->to('/livewire.admin.notification-livewire');
        }
    }

    public function updateNoti()
    {
        $validatedData = $this->validate();

        Notification::where('id',$this->noti_id)->update([
            'title' => $validatedData['title'],
            'massages' => $validatedData['massages'],
        ]);
        session()->flash('message','Notification Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteNoti(int $noti_id)
    {
        $this->noti_id = $noti_id;
    }

    public function destroyNoti()
    {
        Notification::find($this->noti_id)->delete();
        session()->flash('message','Notification Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->title = '';
        $this->massages = '';
    }
    public function render()
    {
        $notifications = Notification::where('title', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(5);

        return view('livewire.admin.notification-livewire',[
            'notifications'=>$notifications,
        ]);
    }
}
