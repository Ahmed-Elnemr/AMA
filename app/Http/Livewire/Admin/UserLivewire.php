<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $email, $user_id, $role_id, $password;
    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required'],
            'password' => 'required',
            'role_id' => 'required',
        ];
    }
    public function data()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::Make($this->password),
            'role_id' => $this->role_id,
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveUser()
    {
        $this->validate();
        $data = $this->data();
        User::create($data);
        session()->flash('message', 'User Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editUser(int $user_id)
    {
        $user = User::find($user_id);
        if ($user) {

            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role_id = $user->role_id;
            $this->password = $user->password;
        } else {
            return redirect()->to('/livewire.admin.user-livewire');
        }
    }

    public function updateUser()
    {
        $this->validate();
        $data = $this->data();
        User::where('id', $this->user_id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['role_id'],
            'password' => $data['password'],
        ]);
        session()->flash('message', 'User Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteUser(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function destroyUser()
    {
        User::find($this->user_id)->delete();
        session()->flash('message', 'User Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->role_id = '';
    }


    public function render()
    {

        $users = User::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $admins=User::where('role_id','ADMIN')->get()->count(); 
        $vendors=User::where('role_id','VENDOR')->get()->count();
        $cusomers=User::where('role_id','USER')->get()->count();
        return view('livewire.admin.user-livewire', [
            'users' => $users,
            'admins'=>$admins,
            'vendors'=>$vendors,
            'cusomers'=>$cusomers,
        ]);
    }
}
