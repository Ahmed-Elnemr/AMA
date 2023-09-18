<?php

namespace App\Http\Livewire\Admin;

use App\Models\Media;
use App\Models\Library;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\DB;


class LibraryLivewire extends Component
{

    use WithPagination;
    use WithFileUploads;


    protected $paginationTheme = 'bootstrap';

    public $libraryId,$librarys_title,$image_file,$url;
    public function mount()
    {
        $this->resetInput();
    }
    protected function rules()
    {
        return [
            'librarys_title' => 'required',
            'url' => 'required',
            // 'media_id' => $this->media()->=>'required',
        ];
    }
    public function saveLibrary()
    {
        $validatedData = $this->validate();
        Library::create($validatedData);
        if ($this->image_file !=null) {
            $this->media();
        }

        session()->flash('message', 'Library Added Successfully');
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
        $last_library_id = DB::table('libraries')->latest()->first();
        $last_media_id = DB::table('media')->latest()->first();
        Library::where('id', $last_library_id->id)->update([
            'media_id' => $last_media_id->id,
        ]);
    }

    public function deleteLibrary(int $libraryId)
    {
        $this->resetInput();
        $this->libraryId = $libraryId;
    }


    public function destroyLibrary()
    {
        $library = Library::find($this->libraryId);
        $library->delete();
        session()->flash('message', 'Library Deleted Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->libraryId = '';
        $this->librarys_title='';
        $this->image_file='';
        $this->url='';


    }

    public function render()
    {
        $library = Library::orderBy('id', 'DESC')->paginate(10);
        // dd($rooms);

        return view('livewire.admin.library-livewire', [
            'library' => $library,
        ]);
    }
}
