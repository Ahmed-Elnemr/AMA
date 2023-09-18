<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;


class OrderLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $orderId;





    public function deleteOrder(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function destroyOrder()
    {
        Order::find($this->orderId)->delete();
        session()->flash('message', 'Order Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->orderId = '';
    }



    public function render()
    {
        // $orders= Order::where('id', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $orders=Order::get();
        // dd($orders);
        return view('livewire.admin.order-livewire',[
            'orders'=>$orders,
        ]);
    }
}
