<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Question;
use App\Models\ChatRooms;
use App\Models\TopRanked;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon as car;

class DashboardLivewire extends Component
{

    // public $rId;
    // public function mount(int $rId)
    // {
    //     $this->rId = $rId;
    // }

    public function render()
    {


        ////
        $customer = User::where('role_id', 'USER')->get()->count();
        $vendor = User::where('role_id', 'VENDOR')->get()->count();
        $admin = User::where('role_id', 'ADMIN')->get()->count();
        $products = Product::count();
        $questions = Question::count();
        $rooms = ChatRooms::count();
        //order
        $completed = Order::where('status', 'completed')->get()->count();
        $pending = Order::where('status', 'pending')->get()->count();
        $cancelld = Order::where('status', 'cancelld')->get()->count();
        $approved = Order::where('status', 'approved')->get()->count();
        //last 5 rooms
        $lastFiveRomms = ChatRooms::orderBy('created_at', 'desc')->take(5)->get();
        //last 5 orders
        $orders = Order::orderBy('created_at', 'desc')->take(5)->get();
        //top ranked
        $topRankeds = TopRanked::orderBy('id', 'DESC')->paginate(6);
        $topRankedCount=$topRankeds->count();
        /// compare to last week
        $date = car::today()->subDays(7);
        $lastsCustomerIn7Day = User::where('created_at','>=',$date)->where('role_id','USER')->get()->count();
        $lastsVendorIn7Day = User::where('created_at','>=',$date)->where('role_id','VENDOR')->get()->count();
        $lastsAdminIn7Day = User::where('created_at','>=',$date)->where('role_id','ADMIN')->get()->count();
        $lastsProductsIn7Day = Product::where('created_at','>=',$date)->get()->count();
        $lastsQuestionsIn7Day = Question::where('created_at','>=',$date)->get()->count();
        $lastsRoomsIn7Day = ChatRooms::where('created_at','>=',$date)->get()->count();
        //last 10 order
        $lastOrders=Order::latest()->take(10)->orderBy('id','desc')->paginate(10);
                    //total order completed price & total offer
        $totalOrderCompletedPrice=Order::where('status','completed')->sum('total');
        $totalOffer=Offer::get()->count();


        return view('livewire.admin.dashboard-livewire', [
            'customer' => $customer,
            'vendor' => $vendor,
            'admin' => $admin,
            'products' => $products,
            'questions' => $questions,
            'rooms' => $rooms,
            //order
            'completed' => $completed,
            'pending' => $pending,
            'cancelld' => $cancelld,
            'approved' => $approved,
            //last 5 rooms
            'lastFiveRomms' => $lastFiveRomms,
            //last 5 orders
            'orders' => $orders,
            //top ranked
            'topRankeds' => $topRankeds,
            //
            'lastsCustomerIn7Day'=>$lastsCustomerIn7Day,
            'lastsVendorIn7Day'=>$lastsVendorIn7Day,
            'lastsAdminIn7Day'=>$lastsAdminIn7Day,
            'lastsProductsIn7Day'=>$lastsProductsIn7Day,
            'lastsQuestionsIn7Day'=>$lastsQuestionsIn7Day,
            'lastsRoomsIn7Day'=>$lastsRoomsIn7Day,
            // last 10 orders
            'lastOrders'=>$lastOrders,
            //count top ranked
            'topRankedCount'=>$topRankedCount,
            //total order completed price & total offer
            'totalOrderCompletedPrice'=>$totalOrderCompletedPrice,
            'totalOffer'=>$totalOffer,



        ]);
    }
}
