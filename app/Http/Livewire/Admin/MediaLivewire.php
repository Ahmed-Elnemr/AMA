<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;




class MediaLivewire extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public  $m_id,  $image_file_update;
    public $search = '';
    protected function rules()
    {
        return [
            'm_id' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    // public $file_name;
    // public function media()
    // {

    //     $file_extension = $this->image_file_update->getClientOriginalName();
    //     $this->file_name = time() . '.' . $file_extension;
    //     $this->image_file_update->storeAs('images', $this->file_name, 'media');
    //     $this->image_file_update = url('/').'/public/images/'. $this->file_name;
    //     Media::create(
    //         [
    //             'path' => $this->image_file_update,
    //         ]
    //     );
    //     $last_cat_id = DB::table('sub_categories')->latest()->first();
    //     $last_media_id = DB::table('media')->latest()->first();
    //     SubCategory::where('id', $last_cat_id->id)->update([
    //         'media_id' => $last_media_id->id,
    //     ]);
    // }

    public function editM(int $m_id)
    {
        $m = Media::find($m_id);
        if ($m) {
            $this->m_id = $m->id;

        } else {
            return redirect()->to('/livewire.admin.media-livewire');
        }
    }

    public function updateM()
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
        $this->image_file_update = url('/')."/public/images/" . $this->file_name;
        Media::create(
            [
                'path' => $this->image_file_update,
            ]);
            $validatedData = $this->validate();
            $last_media_id = DB::table('media')->latest()->first();
        return [
            'subcategories_title' => $validatedData['subcategories_title'],
            'subcategories_body' => $validatedData['subcategories_body'],
            'category_id'=>$validatedData['category_id'],
            'media_id' =>$last_media_id->id,
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
       $media= Media::all();
        return view('livewire.admin.media-livewire',[
            'media'=>$media,
        ]);
    }
}
