<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class SubCategoryLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $subcategories_title, $subcategories_body,$category_id, $media_id, $cat_id, $image_file, $image_file_update;
    public $search = '';
    protected function rules()
    {
        return [
            'subcategories_title' => 'required',
            'subcategories_body' => 'required',
            'category_id'=>'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public $subCatId;
    public function saveSub()
    {

        $validatedData = $this->validate();

        $subCategory= new SubCategory();
        $subCategory->subcategories_title=$this->subcategories_title;
        $subCategory->subcategories_body=$this->subcategories_body;
        $subCategory->category_id=$this->category_id;
        $subCategory->save();
       $this->subCatId= $subCategory->id;
        if ($this->image_file !=null) {
            $this->media();
        }

        session()->flash('message', ' Sub Category Added Successfully');
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
        $media=new Media();
        $media->path = $this->image_file;
        $media->save();
        SubCategory::where('id', $this->subCatId)->update([
            'media_id' => $media->id,
        ]);
    }

    public function editSub(int $cat_id)
    {
        $cat = SubCategory::find($cat_id);
        if ($cat) {
            $this->cat_id = $cat->id;
            $this->subcategories_title = $cat->subcategories_title;
            $this->subcategories_body = $cat->subcategories_body;
            $this->category_id = $cat->category_id;
            $this->media_id = $cat->media_id;

        } else {
            return redirect()->to('/livewire.admin.sub-category-livewire');
        }
    }

    public function updateSub()
    {
        if ($this->image_file_update !=null) {
            $validatedData = $this->validate();
            SubCategory::where('id', $this->cat_id)->update($this->mediaChange());
            session()->flash('message', 'Sub Category Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }else {

            $validatedData = $this->validate();
            SubCategory::where('id', $this->cat_id)->update([
                'subcategories_title' => $validatedData['subcategories_title'],
                'subcategories_body' => $validatedData['subcategories_body'],
                'category_id'=>$validatedData['category_id'],
                'media_id' => $this->media_id,
            ]);
            session()->flash('message', ' Sub Category Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }

    }
    public function mediaChange(){

        $file_extension = $this->image_file_update->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->image_file_update->storeAs('images', $this->file_name, 'media');
        $this->image_file_update = url('/')."/images/" . $this->file_name;

            $media=new Media();
            $media->path=$this->image_file_update;
            $media->save();
            $validatedData = $this->validate();
        return [
            'subcategories_title' => $validatedData['subcategories_title'],
            'subcategories_body' => $validatedData['subcategories_body'],
            'category_id'=>$validatedData['category_id'],
            'media_id' =>$media->id,
        ];


    }


    public function deleteSub(int $cat_id)
    {
        $this->cat_id = $cat_id;
    }

    public function destroySub()
    {
        SubCategory::find($this->cat_id)->delete();
        // unlink($sub->path);
        session()->flash('message', ' Sub Category Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->cat_id = '';
        $this->subcategories_title = '';
        $this->subcategories_body = '';
        $this->category_id='';
        $this->media_id = '';
        $this->image_file_update='';
    }

    public function render()
    {

        $subs = SubCategory::where('subcategories_title', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(5);
        $categories=Category::all();
        $allSub=SubCategory::count();
        return view('livewire.admin.sub-category-livewire',[
            'subs'=>$subs,
            'categories'=>$categories,
            'allSub'=>$allSub,
        ]);
    }
}
