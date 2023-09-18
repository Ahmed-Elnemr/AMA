<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeleteAcountLivewire extends Component
{
    public $email, $password;

    public function mount()
    {
        $this->closeModal();
    }


    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function deleteUser()
    {
        $this->validate();
        $this->dispatchBrowserEvent('open-modal');
    }

    public function destroyUser()
    {

        $this->validate();

        $user = DB::table('users')
            ->where('email', $this->email)
            ->first();

        if ($user && password_verify($this->password, $user->password)) {

            User::destroy($user->id);
            session()->flash('message', 'Acount Deleted  successfully.');
        } else {
            session()->flash('message', 'Invalid email or password.');
        }
        $this->dispatchBrowserEvent('close-modal');



        $this->closeModal();
    }

    public function closeModal()
    {
        $this->password = '';
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.admin.delete-acount-livewire');
    }
}
