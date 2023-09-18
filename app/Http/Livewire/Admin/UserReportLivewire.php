<?php

namespace App\Http\Livewire\Admin;

use App\Models\UserReport;
use Livewire\Component;

class UserReportLivewire extends Component
{




    public function status(int $id)
    {
        $report = UserReport::find($id);
        if ($report->status == 'aproved' ) {
            UserReport::find($id)->update([
                'status' => 'rejected',
            ]);
        } elseif ($report->status == 'rejected' ) {
            UserReport::find($id)->update([
                'status' => 'aproved',
            ]);
        }elseif($report->status == ''){
            UserReport::find($id)->update([
                'status' => 'aproved',
            ]);
        }
    }
    public function render()
    {
        // $reports = UserReport::get();
        $reports = UserReport::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.user-report-livewire', [
            'reports' => $reports,
        ]);
    }
}
