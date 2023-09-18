<?php

namespace App\Http\Livewire\Admin;

use App\Models\BusinessInformation;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Media;
use App\Models\User;
use Illuminate\Cache\NullStore;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VendorLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $name, $email, $password, $legal_name, $logo_media, $update_logo_media,
    $cover_media, $update_cover_media, $category_id, $user_id;
    public $selectedCat;
    public $search = '';

    public function mount()
    {
        $this->resetInput();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required'],
            'password' => 'required',
            'legal_name' => 'required',
            'category_id' => 'required',
            'logo_media'=> 'required',
            'cover_media'=> 'required',
        ];
    }

    public function data()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::Make($this->password),
            'role_id' => 'VENDOR',
        ];
    }
    public function businessData()
    {
        if (!empty($this->logo_media && $this->cover_media)) {
            return [
                'legal_name' => $this->legal_name,
                'user_id' => $this->user_id,
                'logo_media_id' => $this->logoMedia(),
                'cover_media_id' => $this->coverMedia(),
                'categories_id' => $this->category_id,
                'slug_name' => $this->legal_name,
            ];
        } else if (!empty($this->logo_media)) {
            return [
                'legal_name' => $this->legal_name,
                'user_id' => $this->user_id,
                'logo_media_id' => $this->logoMedia(),
                // 'cover_media_id' => $this->coverMedia(),
                'categories_id' => $this->category_id,
                'slug_name' => $this->legal_name,
            ];
        } else if (!empty($this->cover_media)) {
            return [
                'legal_name' => $this->legal_name,
                'user_id' => $this->user_id,
                // 'logo_media_id' => $this->logoMedia(),
                'cover_media_id' => $this->coverMedia(),
                'categories_id' => $this->category_id,
                'slug_name' => $this->legal_name,
            ];
        } else {
            return [
                'legal_name' => $this->legal_name,
                'user_id' => $this->user_id,
                // 'logo_media_id' => $this->logoMedia(),
                // 'cover_media_id' => $this->coverMedia(),
                'categories_id' => $this->category_id,
                'slug_name' => $this->legal_name,
            ];
        }
    }
    public $file_name;
    public function logoMedia()
    {

        $file_extension = $this->logo_media->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->logo_media->storeAs('images', $this->file_name, 'media');
        $this->logo_media = url('/') . '/images/' . $this->file_name;

        $media = new Media();
        $media->path = $this->logo_media;
        $media->save();
        $this->file_name = '';
        return $media->id;


    }
    public function coverMedia()
    {

        $file_extension = $this->cover_media->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->cover_media->storeAs('images', $this->file_name, 'media');
        $this->cover_media = url('/') . '/images/' . $this->file_name;

        $media = new Media();
        $media->path = $this->cover_media;
        $media->save();
        $this->file_name = '';
        return $media->id;


    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveVendor()
    {
        $this->validate();
        $data = $this->data();
        User::create($data);
        $user = DB::table('users')->latest()->first();
        $this->user_id = $user->id;
        BusinessInformation::create($this->businessData());
        session()->flash('message', 'Vendor Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public $logo_media_id, $cover_media_id;

    public function editVendor(int $user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = $user->password;
            if ($user->business !=null) {
                $this->legal_name = '';
                $this->logo_media_id = '';
                $this->cover_media_id = '';
                $this->category_id = '';
            }
            $user->business->legal_name != null ?  $this->legal_name = $user->business->legal_name : '';
            $user->business->logoMedia->id != null ?  $this->logo_media_id = $user->business->logoMedia->id : '';
            $user->business->coverMedia->id != null ?  $this->cover_media_id = $user->business->coverMedia->id : '';
            $user->business->categories_id != null ?  $this->category_id = $user->business->categories_id : '';


        } else {
            return redirect()->to('/livewire.admin.vendor-livewire');
        }
    }

    public function updateVendor()
    {
        if ($this->update_cover_media != null && $this->update_logo_media != null) {
            $file_extension = $this->update_cover_media->hashName();
            $this->file_name = time() . '.' . $file_extension;
            $this->update_cover_media->storeAs('images', $this->file_name, 'media');
            $this->update_cover_media = url('/') . '/images/' . $this->file_name;

            $mediaCover = new Media();
            $mediaCover->path = $this->update_cover_media;
            $mediaCover->save();
            $this->file_name = '';
            //
            $file_extension = $this->update_logo_media->hashName();
            $this->file_name = time() . '.' . $file_extension;
            $this->update_logo_media->storeAs('images', $this->file_name, 'media');
            $this->update_logo_media = url('/') . '/images/' . $this->file_name;

            $mediaLogo = new Media();
            $mediaLogo->path = $this->update_logo_media;
            $mediaLogo->save();
            $this->file_name = '';

            // $this->validate();
            $data = $this->data();
            User::where('id', $this->user_id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                // 'password' => $data['password'],
            ]);
            $bData = $this->businessData();
            BusinessInformation::where('user_id', $this->user_id)->update([
                'legal_name' => $bData['legal_name'],
                'categories_id' => $bData['categories_id'],
                'slug_name' => $bData['slug_name'],
                'logo_media_id' => $mediaLogo->id,
                'cover_media_id' => $mediaCover->id,
            ]);

            session()->flash('message', 'Vendor Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            //////
        } else if ($this->update_cover_media != null) {
            // dd($this->update_cover_media->hashName());
            // $this->validate();
            $file_extension = $this->update_cover_media->hashName();
            $this->file_name = time() . '.' . $file_extension;
            $this->update_cover_media->storeAs('images', $this->file_name, 'media');
            $this->update_cover_media = url('/') . '/images/' . $this->file_name;

            $mediaCover = new Media();
            $mediaCover->path = $this->update_cover_media;
            $mediaCover->save();
            $this->file_name = '';

            $data = $this->data();
            User::where('id', $this->user_id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                // 'password' => $data['password'],
            ]);
            $bData = $this->businessData();
            BusinessInformation::where('user_id', $this->user_id)->update([
                'legal_name' => $bData['legal_name'],
                'categories_id' => $bData['categories_id'],
                'slug_name' => $bData['slug_name'],
                'logo_media_id' => $this->logo_media_id,
                'cover_media_id' => $mediaCover->id,
            ]);

            session()->flash('message', 'Vendor Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            //////
        }else if ($this->update_logo_media != null){

   $file_extension = $this->update_logo_media->hashName();
            $this->file_name = time() . '.' . $file_extension;
            $this->update_logo_media->storeAs('images', $this->file_name, 'media');
            $this->update_logo_media = url('/') . '/images/' . $this->file_name;

            $mediaLogo = new Media();
            $mediaLogo->path = $this->update_logo_media;
            $mediaLogo->save();
            $this->file_name = '';
            // $this->validate();
            $data = $this->data();
            User::where('id', $this->user_id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                // 'password' => $data['password'],
            ]);
            $bData = $this->businessData();
            BusinessInformation::where('user_id', $this->user_id)->update([
                'legal_name' => $bData['legal_name'],
                'categories_id' => $bData['categories_id'],
                'slug_name' => $bData['slug_name'],
                'logo_media_id' => $mediaLogo->id,
                'cover_media_id' => $this->cover_media_id,
            ]);

            session()->flash('message', 'Vendor Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
            //////
        } else {
            // $this->validate();
            $data = $this->data();
            User::where('id', $this->user_id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                // 'password' => $data['password'],
            ]);
            $bData = $this->businessData();
            BusinessInformation::where('user_id', $this->user_id)->update([
                'legal_name' => $bData['legal_name'],
                'categories_id' => $bData['categories_id'],
                'slug_name' => $bData['slug_name'],
                'logo_media_id' => $this->logo_media_id,
                'cover_media_id' => $this->cover_media_id,
            ]);

            session()->flash('message', 'Vendor Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }

    }

    public function mediaChange()
    {

    }

    public function deleteVendor(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function destroyVendor()
    {
        User::find($this->user_id)->delete();
        $this->resetInput();
        session()->flash('message', 'Vendor Deleted Successfully');
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
        $this->password = '';
        $this->legal_name = '';
        $this->logo_media = '';
        $this->cover_media = '';
        $this->category_id = '';
        $this->user_id = '';
        $this->update_cover_media = '';
        $this->update_logo_media = '';

    }

    public function render()
    {
        $vendors = User::where('role_id', 'VENDOR')->where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $main_categories = MainCategory::all();
        $categories = Category::all();
        return view('livewire.admin.vendor-livewire', [
            'vendors' => $vendors,
            'main_categories' => $main_categories,
            'categories' => $categories,
        ]);
    }
}
