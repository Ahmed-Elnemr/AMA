<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use App\Models\User;
use Livewire\Component;
use App\Models\MainCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class MainCategoryLivewire extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $main_categories_title, $main_categories_body, $media_id, $main_cat_id, $image_file, $image_file_update;
    public $search = '';
    protected function rules()
    {
        return [
            'main_categories_title' => 'required',
            'main_categories_body' => 'required',
        ];
    }



    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public $mCatId;
    public function saveMcat()
    {

        $mainCategory= new MainCategory();
        $mainCategory->main_categories_title=$this->main_categories_title;
        $mainCategory->main_categories_body=$this->main_categories_body;
        $mainCategory->save();
        $this->mCatId=$mainCategory->id;

        if ($this->image_file != null) {
            $this->media();
        }

        session()->flash('message', 'Main Category Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public $file_name;
    public function media()
    {


        $file_extension = $this->image_file->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->image_file->storeAs('images', $this->file_name, 'media');
        $this->image_file = url('/') . '/images/' . $this->file_name;


        $media= new Media();
        $media->path = $this->image_file;
        $media->save();

        MainCategory::where('id', $this->mCatId)->update([

            'media_id' => $media->id,

        ]);
    }

    public function editMcat(int $m_cat_id)
    {
        $m_cat = MainCategory::find($m_cat_id);
        if ($m_cat) {
            $this->main_cat_id = $m_cat->id;
            $this->main_categories_title = $m_cat->main_categories_title;
            $this->main_categories_body = $m_cat->main_categories_body;
            $this->media_id = $m_cat->media_id;
        } else {
            return redirect()->to('/livewire.admin.main-category-livewire');
        }
    }

    public function updateMcat()
    {
        if ($this->image_file_update != null) {
            $validatedData = $this->validate();
            MainCategory::where('id', $this->main_cat_id)->update($this->mediaChange());
            session()->flash('message', 'Main Category Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $validatedData = $this->validate();
            MainCategory::where('id', $this->main_cat_id)->update([
                'main_categories_title' => $validatedData['main_categories_title'],
                'main_categories_body' => $validatedData['main_categories_body'],
                'media_id' => $this->media_id,
            ]);
            session()->flash('message', 'Main Category Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function mediaChange()
    {

        $file_extension = $this->image_file_update->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->image_file_update->storeAs('images', $this->file_name, 'media');
        $this->image_file_update = url('/') . "/images/" . $this->file_name;
        $media= new Media();
        $media->path = $this->image_file_update;
        $media->save();

        $validatedData = $this->validate();
        return [
            'main_categories_title' => $validatedData['main_categories_title'],
            'main_categories_body' => $validatedData['main_categories_body'],
            'media_id' => $media->id,
        ];
    }


    public function deleteMcat(int $m_cat_id)
    {
        $this->main_cat_id = $m_cat_id;
    }

    public function destroyMcat()
    {
        MainCategory::find($this->main_cat_id)->delete();
        session()->flash('message', 'Main Category Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->image_file_update = '';
        $this->main_categories_title = '';
        $this->main_categories_body = '';
        $this->media_id='';
        $this->main_cat_id='';
        $this->image_file='';
        $this->image_file_update='';
    }

    public function render()
    {

        $main_categories = MainCategory::where('main_categories_title', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $allMain = MainCategory::count();
        return view('livewire.admin.main-category-livewire', [
            'main_categories' => $main_categories,
            'allMain' => $allMain,
        ]);
    }
}
