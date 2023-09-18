<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;


class OrganizationLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // public $main_categories_title, $main_categories_body, $media_id, $main_cat_id, $image_file, $image_file_update;
    public $org_id,$organizations_name, $organizations_txt_body, $organizations_phone, $url, $organizations_bank_account, $media_id,$image_file,$image_file_update;

    public $search = '';
    protected function rules()
    {
        return [
            'organizations_name' => 'required',
            'organizations_txt_body' => 'required',
            'organizations_phone'=>'required',
            'url'=>'required',
            'organizations_bank_account'=>'required',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveOrg()
    {

        $validatedData = $this->validate();
        Organization::create($validatedData);
        if ($this->image_file !=null) {
            $this->media();
        }

        session()->flash('message', 'Organization Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public $file_name;
    public function media()
    {

        $file_extension = $this->image_file->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->image_file->storeAs('images', $this->file_name, 'media');
        $this->image_file = url('/').'/images/'. $this->file_name;
        Media::create(
            [
                'path' => $this->image_file,
            ]
        );
        $last_org_id = DB::table('organizations')->latest()->first();
        $last_media_id = DB::table('media')->latest()->first();
        Organization::where('id', $last_org_id->id)->update([
            'media_id' => $last_media_id->id,
        ]);
    }

    public function editOrg(int $org_id)
    {
        $org = Organization::find($org_id);
        if ($org) {
            $this->org_id=$org->id;
            $this->organizations_name = $org->organizations_name;
            $this->organizations_txt_body = $org->organizations_txt_body;
            $this->organizations_phone = $org->organizations_phone;
            $this->url = $org->url;
            $this->organizations_bank_account = $org->organizations_bank_account;
            $this->media_id = $org->media_id;

        } else {
            return redirect()->to('/livewire.admin.organization-livewire');
        }
    }

    public function updateOrg()
    {
        if ($this->image_file_update !=null) {
            $validatedData = $this->validate();
            Organization::where('id', $this->org_id)->update($this->mediaChange());
            session()->flash('message', 'Organization Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }else {
            $validatedData = $this->validate();
            Organization::where('id', $this->org_id)->update([
                'organizations_name' => $validatedData['organizations_name'],
                'organizations_txt_body' => $validatedData['organizations_txt_body'],
                'organizations_phone' => $validatedData['organizations_phone'],
                'url' => $validatedData['url'],
                'organizations_bank_account' => $validatedData['organizations_bank_account'],
                'media_id' => $this->media_id,
            ]);
            session()->flash('message', 'Organization Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }

    }
    public function mediaChange(){

        $file_extension = $this->image_file_update->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->image_file_update->storeAs('images', $this->file_name, 'media');
        $this->image_file_update = url('/')."/images/". $this->file_name;
        Media::create(
            [
                'path' => $this->image_file_update,
            ]);
            $validatedData = $this->validate();
            $last_media_id = DB::table('media')->latest()->first();
        return [
            'organizations_name' => $validatedData['organizations_name'],
            'organizations_txt_body' => $validatedData['organizations_txt_body'],
            'organizations_phone' => $validatedData['organizations_phone'],
            'url' => $validatedData['url'],
            'organizations_bank_account' => $validatedData['organizations_bank_account'],
            'media_id' =>$last_media_id->id,
        ];


    }


    public function deleteOrg(int $org_id)
    {
        $this->org_id = $org_id;
    }

    public function destroyOrg()
    {
        Organization::find($this->org_id)->delete();
        session()->flash('message', 'Organization Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->organizations_name = '';
        $this->organizations_txt_body = '';
        $this->organizations_phone = '';
        $this->url = '';
        $this->organizations_bank_account = '';
        $this->media_id = '';
        $this->org_id='';
    }

    public function render()
    {

        $organizations = Organization::where('organizations_name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(6);

        return view('livewire.admin.organization-livewire', [
            'organizations' => $organizations,

        ]);
    }
}
