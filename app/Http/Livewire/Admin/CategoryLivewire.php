<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Livewire\Component;
use App\Models\Category;
use App\Models\MainCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class CategoryLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $categories_title, $categories_body,$main_categories_id, $media_id, $cat_id, $image_file, $image_file_update;
    public $search = '';
    protected function rules()
    {
        return [
            'categories_title' => 'required',
            'categories_body' => 'required',
            'main_categories_id'=>'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public $categoryId;
    public function saveCat()
    {

        // $validatedData = $this->validate();
        // Category::create($validatedData);
        $this->validate();
        $category= new Category();
        $category->categories_title=$this->categories_title;
        $category->categories_body=$this->categories_body;
        $category->main_categories_id=$this->main_categories_id;
        $category->save();
         $this->categoryId=$category->id;
        if ($this->image_file !=null) {
            $this->media();
        }

        session()->flash('message', ' Category Added Successfully');
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

        $media= new Media();
        $media->path = $this->image_file;
        $media->save();
        Category::where('id', $this->categoryId)->update([
            'media_id' => $media->id,
        ]);
    }

    public function editCat(int $cat_id)
    {
        $cat = Category::find($cat_id);
        if ($cat) {
            $this->cat_id = $cat->id;
            $this->categories_title = $cat->categories_title;
            $this->categories_body = $cat->categories_body;
            $this->main_categories_id = $cat->main_categories_id;
            $this->media_id = $cat->media_id;

        } else {
            return redirect()->to('/livewire.admin.category-livewire');
        }
    }

    public function updateCat()
    {
        if ($this->image_file_update !=null) {
            $validatedData = $this->validate();
            Category::where('id', $this->cat_id)->update($this->mediaChange());
            session()->flash('message', ' Category Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }else {

            $validatedData = $this->validate();
            Category::where('id', $this->cat_id)->update([
                'categories_title' => $validatedData['categories_title'],
                'categories_body' => $validatedData['categories_body'],
                'main_categories_id'=>$validatedData['main_categories_id'],
                'media_id' => $this->media_id,
            ]);
            session()->flash('message', ' Category Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }

    }
    public function mediaChange(){

        $file_extension = $this->image_file_update->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->image_file_update->storeAs('images', $this->file_name, 'media');
        $this->image_file_update = url('/')."/images/" . $this->file_name;
        $media= new Media();
        $media->path = $this->image_file_update;
        $media->save();
            $validatedData = $this->validate();
        return [
            'categories_title' => $validatedData['categories_title'],
            'categories_body' => $validatedData['categories_body'],
            'main_categories_id'=>$validatedData['main_categories_id'],
            'media_id' =>$media->id,
        ];


    }


    public function deleteCat(int $cat_id)
    {
        $this->cat_id = $cat_id;
    }

    public function destroyCat()
    {
        Category::find($this->cat_id)->delete();
        session()->flash('message', ' Category Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->cat_id = '';
        $this->categories_title = '';
        $this->categories_body = '';
        $this->main_categories_id='';
        $this->media_id = '';
        $this->image_file_update='';
        $this->cat_id='';
        $this->image_file='';

    }
    public function render()
    {
        $categories = Category::where('categories_title', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $main_categories=MainCategory::all();
        $cats=Category::count();
        return view('livewire.admin.category-livewire',[
            'categories'=>$categories,
            'main_categories'=>$main_categories,
            'cats'=>$cats,
        ]);
    }
}
