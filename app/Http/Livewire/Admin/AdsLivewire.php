<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ads;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\BusinessInformation;


class AdsLivewire extends Component
{


    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public
        $user_id,
        $business_profile_id,
        $start_date,
        $end_date,
        $fund_source,
        $fund_amount,
        $day_price,
        $view_price,
        $adsId;




    // public $proId, $products_name, $products_price, $products_unite_name, $products_uinites;

    public function saveAds()
    {
        $data = $this->data();
        Ads::create($data);


        session()->flash('message', 'Ads Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }




    ################################
    public function data()
    {
        return [
            'business_profile_id' => $this->business_profile_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'view_count' => 0,
            'day_price' => $this->day_price,
            'view_price' => $this->view_price,
            'fund_source' => $this->fund_source,
            'fund_amount' => $this->fund_amount,
        ];
    }

    public function editData()
    {
        return [
            'business_profile_id' => $this->business_profile_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'day_price' => $this->day_price,
            'view_price' => $this->view_price,
            'fund_source' => $this->fund_source,
            'fund_amount' => $this->fund_amount,
        ];
    }

    public function updateAds()
    {
        Ads::where('id', $this->adsId)->update($this->editData());
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function editAds(int $adsId)
    {
        $this->adsId =  $adsId;
        $ads = Ads::find($adsId);

        if ($ads) {
            $this->business_profile_id = $ads->business_profile_id;
            $this->start_date = $ads->start_date;
            $this->end_date = $ads->end_date;
            $this->day_price = $ads->day_price;
            $this->view_price = $ads->view_price;
            $this->fund_source = $ads->fund_source;
            $this->fund_amount = $ads->fund_amount;
        } else {
            // return redirect()->to('/livewire.productcategory-livewire');
        }
    }

    public function deleteAds(int $adsId)
    {
        $this->resetInput();
        $this->adsId = $adsId;
    }


    public function destroyAds()
    {
        $product = Ads::find($this->adsId);
        $product->delete();
        session()->flash('message', 'Ads Deleted Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->adsId = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->day_price = '';
        $this->fund_source = '';
        $this->fund_amount = '';

    }


    public function render()
    {
        // $select = array(
        //     "ads.id as id",
        //     "businessProfile.legal_name as legal_name",
        //     "businessProfile.logoMedia as logo_media_id",
        //     "ads.start_date as start_date",
        //     "ads.end_date as end_date",
        //     "ads.day_price as day_price",
        //     "ads.fund_source as fund_source",
        //     "ads.fund_amount as fund_amount",
        //     "ads.view_count as view_count",
        //     "ads.view_price as view_price",

        // );


        // $adss =  DB::table('ads')
        // ->select(  $select )
        // ->leftJoin('business_information as businessProfile', 'businessProfile.id', '=', 'ads.business_profile_id')
        // ->where('businessProfile.legal_name', 'like', '%' . $this->search. '%')
        // ->orderBy('ads.id', 'desc')->paginate(10);

        // $adss = Ads::where('name', 'like', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
        $adss = Ads::orderBy('id', 'DESC')->paginate(10);
        $business = BusinessInformation::get();
        return view(
            'livewire.admin.ads-livewire',
            [
                'adss' => $adss,
                'business' => $business,
            ]
        );
    }
}
