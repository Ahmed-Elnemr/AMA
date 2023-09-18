<?php

namespace App\Http\Livewire\Admin;

use App\Models\MainCategory;
use App\Models\SubscriptionPkg;
use Livewire\Component;

class SubbscriotionPkgLivewire extends Component
{

    public $pkg_name,
        $main_categories_id,
        $pkgId,
        $deletedPkgId;
    protected function rules()
    {
        return [
            'pkg_name' => 'required',
            'main_categories_id' => ['required'],
        ];
    }

    public function savePkg()
    {
        $this->validate();
        $package = new SubscriptionPkg();
        $package->pkg_name = $this->pkg_name;
        $package->main_categories_id = $this->main_categories_id;
        $package->save();
        session()->flash('message', 'Package Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function editPkg($pkgId)
    {
        $this->pkgId = $pkgId;
        $pakage =  SubscriptionPkg::where('id', $pkgId)->first();
        $this->pkg_name = $pakage->pkg_name;
        $this->main_categories_id  = $pakage->main_categories_id;
    }

    public function updatePkg()
    {
        SubscriptionPkg::where('id', $this->pkgId)->update([
            'pkg_name' => $this->pkg_name,
            'main_categories_id' => $this->main_categories_id,
        ]);
        session()->flash('message', 'Package Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }



    public function deletePkg(int $deletedPkgId)
    {
        $this->deletedPkgId = $deletedPkgId;
    }

    public function destroyPkg()
    {
        SubscriptionPkg::find($this->deletedPkgId)->delete();
        session()->flash('message', 'Package  Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->pkg_name = '';
        $this->main_categories_id = '';
    }


    public function render()
    {
        $countPackages = SubscriptionPkg::count();
        $packages = SubscriptionPkg::orderBy('id','desc')-> get();
        $main_categories = MainCategory::get();
        return view('livewire.admin.subbscriotion-pkg-livewire', [
            'countPackages' => $countPackages,
            'packages' => $packages,
            'main_categories' => $main_categories,

        ]);
    }
}
