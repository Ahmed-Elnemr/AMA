<?php

namespace App\Http\Livewire\Admin;

use App\Models\ChatRooms;
use Livewire\Component;
use Livewire\WithPagination;

class ChatLivewire extends Component
{


    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $roomId;

    public function deleteRoom(int $roomId)
    {
        $this->resetInput();
        $this->roomId = $roomId;
    }


    public function destroyRoom()
    {
        $room = ChatRooms::find($this->roomId);
        $room->delete();
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->roomId = '';
    }

    public function render()
    {
        $rooms = ChatRooms::orderBy('id', 'DESC')->paginate(10);

        // dd($rooms);

        return view('livewire.admin.chat-livewire', [
            'rooms' => $rooms,
        ]);

    }
}
