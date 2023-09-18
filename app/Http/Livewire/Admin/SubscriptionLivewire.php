<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Subscription;
use App\Models\SubscriptionPkg;
use App\Models\BusinessInformation;

class SubscriptionLivewire extends Component
{
    public $userId;
    public
        $subscription_start,
        $subscription_end,
        $duration_in_days,
        $subscription_pkg_id,
        $user_id,
        $business_information_id,
        $subscriptionId,
        $deletedSubId;
        protected function rules()
        {
            return [
                'subscription_start' => 'required',
                'subscription_end' => ['required'],
                'duration_in_days' => 'required',
                'subscription_pkg_id' => 'required',
            ];
        }

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function saveSubscription()
    {
        $this->validate();
        $subscription = new  Subscription();
        $subscription->subscription_start = $this->subscription_start;
        $subscription->subscription_end = $this->subscription_end;
        $subscription->duration_in_days = $this->duration_in_days;
        $subscription->subscription_pkg_id = $this->subscription_pkg_id;
        $business = BusinessInformation::where('user_id', $this->userId)->first();
        if (isset($business->id)) {
            $subscription->business_information_id = $business->id;
        }
        $subscription->user_id = $this->userId;
        $subscription->save();
        session()->flash('message', 'Subbscription  Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function editSubscription($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;
        $subscription =  Subscription::where('id', $subscriptionId)->first();
        $this->subscription_start = $subscription->subscription_start;
        $this->subscription_end  = $subscription->subscription_end;
        $this->duration_in_days = $subscription->duration_in_days;
        $this->subscription_pkg_id = $subscription->subscription_pkg_id;
        $this->userId = $subscription->user_id;
    }

    public function updateSubscription()
    {
        Subscription::where('id', $this->subscriptionId)->update([
            'subscription_start' => $this->subscription_start,
            'subscription_end' => $this->subscription_end,
            'duration_in_days' => $this->duration_in_days,
            'subscription_pkg_id' => $this->subscription_pkg_id,
        ]);
        session()->flash('message', 'Subbscription Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteSub(int $deletedSubId)
    {
        $this->deletedSubId = $deletedSubId;
    }

    public function destroySub()
    {
        Subscription::find($this->deletedSubId)->delete();
        session()->flash('message', 'Subbscription Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->subscription_start = '';
        $this->subscription_end = '';
        $this->duration_in_days = '';
        $this->subscription_pkg_id = '';
        $this->user_id = '';
        $this->business_information_id = '';
        $this->subscriptionId = '';
    }


    public function render()
    {
        $subscriptions = Subscription::where('user_id', $this->userId)->orderBy('id','Desc')->get();
        $subCountUser = $subscriptions->count();
        $pkgs = SubscriptionPkg::get();
        return view('livewire.admin.subscription-livewire', [
            'subscriptions' => $subscriptions,
            'subCountUser' => $subCountUser,
            'pkgs' => $pkgs,
        ]);
    }
}
