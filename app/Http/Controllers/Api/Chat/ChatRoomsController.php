<?php
namespace App\Http\Controllers\Api\Chat;

use App\Models\ChatRooms;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class ChatRoomsController extends Controller
{

    public function index(Request $request)
    {

        if($request->q != null){

            return ChatRooms::where('room_name' , 'like', '%'.$request->q.'%' )->with('media')->with("owner")->with('rlog')->orderBy('id', 'DESC')->paginate(25);
        }else{
            return ChatRooms::with('media')->with("owner")->with('rlog')->orderBy('id', 'DESC')->paginate(25);

        }


    }


    public function create()
    {


    }


    public function store(Request $request)
    {


        $authUser = User::find(\Auth::id());


        if($authUser != null) {
            $chatRooms = new ChatRooms();
            $chatRooms->room_name = $request->room_name;
            $chatRooms->room_is_private = $request->room_is_private;
            $chatRooms->chat_key = $request->chat_key;
            $chatRooms->owner_users_id = $authUser->id;

            $chatRooms->save();
            $r =  ChatRooms::where('id', $chatRooms->id)->with('media')->with("owner")->with('rlog')->first();
          //  $r= $r->makeHidden(['chat_key']);

            return $r;
        }else{

            return response()->json([
                'message' => 'Invalid login details'
                        ], 401);
        }

    }


    public function show(ChatRooms $chatRooms)
    {

    }


    public function edit(ChatRooms $chatRooms)
    {

    }


    public function update(Request $request, ChatRooms $chatRooms)
    {

    }


    public function destroy(ChatRooms $chatRooms)
    {

    }
}
