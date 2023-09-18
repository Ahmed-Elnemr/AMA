<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Media;
use App\Models\Offer;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class OfferLivewire extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $offers_discount, $offers_start, $offers_end, $offers_title,
     $offers_code, $offers_limits, $business_information_id, $offer_id,$media_id;
    public $search = '';

    protected function rules()
    {
        return [
            'offers_title'=>'required',
            'offers_discount' => 'required',
            'offers_start' => 'required',
            'offers_end' => 'required',
            'offers_code' => 'required',
            'offers_limits' => 'required',
            'business_information_id' => 'required',

        ];
    }
    public function data()
    {
        return [
            'offers_title'=>$this->offers_title,
            'offers_discount' => $this->offers_discount,
            'offers_start' => $this->offers_start,
            'offers_end' =>$this->offers_end,
            'offers_code' => $this->offers_code,
            'offers_limits' => $this->offers_limits,
            'business_information_id' =>$this->business_information_id,
            'user_id' =>Auth::user()->id,
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveOffer()
    {
        // $data = $this->validate();
        // $data = $this->data();
        Offer::create($this->data());
        //save user id
        if ($this->media_id !=null) {
            $this->media();
        }
        session()->flash('message', 'Offer Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public $file_name;
    public function media()
    {

        $file_extension = $this->media_id->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->media_id->storeAs('images', $this->file_name, 'media');
        $this->media_id = url('/').'/images/'. $this->file_name;
        Media::create(
            [
                'path' => $this->media_id,
            ]
        );
        $last_offer_id = DB::table('offers')->latest()->first();
        $last_media_id = DB::table('media')->latest()->first();
        Offer::where('id', $last_offer_id->id)->update([
            'media_id' => $last_media_id->id,
        ]);
    }

    public function editOffer(int $offer_id)
    {
        $offer = Offer::find($offer_id);
        if ($offer) {

            $this->offer_id = $offer->id;
            $this->offers_discount = $offer->offers_discount;
            $this->offers_start = $offer->offers_start;
            $this->offers_end = $offer->offers_end;
            $this->offers_title = $offer->offers_title;
            $this->offers_code = $offer->offers_code;
            $this->offers_limits = $offer->offers_limits;
            $this->business_information_id = $offer->business_information_id;
        } else {
            return redirect()->to('/livewire.admin.offer-livewire');
        }
    }

    public function updateOffer()
    {
        Offer::where('id',  $this->offer_id)->update([
            'offers_title'=>$this->offers_title,
            'offers_discount' => $this->offers_discount,
            'offers_start' => $this->offers_start,
            'offers_end' =>$this->offers_end,
            'offers_code' => $this->offers_code,
            'offers_limits' => $this->offers_limits,
            'business_information_id' =>$this->business_information_id,

        ]);


        if ($this->media_id != null) {
            Offer::where('id',  $this->offer_id)->update($this->mediaChange());
            session()->flash('message', ' Offer Updated Successfully');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }
        session()->flash('message', 'Offer Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function mediaChange(){

        $file_extension = $this->media_id->hashName();
        $this->file_name = time() . '.' . $file_extension;
        $this->media_id->storeAs('images', $this->file_name, 'media');
        $this->media_id = url('/')."/images/" . $this->file_name;
        Media::create(
            [
                'path' => $this->media_id,
            ]);
            // $validatedData = $this->validate();
            $last_media_id = DB::table('media')->latest()->first();
        return [
            'offers_title'=>$this->offers_title,
            'offers_discount' => $this->offers_discount,
            'offers_start' => $this->offers_start,
            'offers_end' =>$this->offers_end,
            'offers_code' => $this->offers_code,
            'offers_limits' => $this->offers_limits,
            'business_information_id' =>$this->business_information_id,
            'media_id' =>$last_media_id->id,

        ];


    }

    public function deleteOffer(int $offer_id)
    {
        $this->offer_id = $offer_id;
    }

    public function destroyOffer()
    {
        Offer::find($this->offer_id)->delete();
        session()->flash('message', 'Offer Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->offers_discount = '';
        $this->offers_start = '';
        $this->offers_end = '';
        $this->offers_title = '';
        $this->offers_code = '';
        $this->offers_limits = '';
        $this->business_information_id = '';
        $this->media_id = '';
        $this->offer_id = '';
    }


    public function render()
    {
        // $startDate = Carbon::parse(date(now()))->startOfDay();
        // dd($startDate);
        $business = BusinessInformation::get();
        $offers = Offer::where('offers_title', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.offer-livewire', [
            'offers' => $offers,
            'business' => $business,
        ]);
    }
}
