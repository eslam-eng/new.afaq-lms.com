<?php

namespace App\Http\Controllers\API\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTicketRequest;
use App\Http\Resources\OneTicketCommentResource;
use App\Http\Resources\OneTicketResource;
use App\Http\Resources\TicketCategoryResource;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use League\Glide\Api\Api;

class TicketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function MyTicket()
    {
        try {
            $user = auth()->user();
            $ticket = Ticket::where(['user_id' => $user->id])->with('ticket_category')->get();
            $data =  TicketResource::collection($ticket);
            return $this->toJson($data);


        } catch (\Throwable $th) {
//            return $th;
            return $this->toJson(null, 400, $th->getMessage(), false);
        }


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreTicket(Request $request)
    {

        $request->validate([
            'title'         => 'required',
            'description'       => 'required',
           // 'user_id' => 'required|int|exists:users,id',
            'ticket_category_id' => 'required|int|exists:ticket_categories,id',
            'email'  => 'nullable|email|exists:users,email',
            'image' => 'image|nullable|mimes:jpeg,png,jpg|max:1024',
        ]);
        $data=$request->all();
        try {
            if (isset( $data['image'])){
                $data['image'] = $data['image']->store('ticket-image','public');
            }
            $data['user_id']=auth()->user()->id;
            $ticket = Ticket::create($data);

            return response()->json([
                "status" => true,
                "With ID" =>$ticket->id,
                "message" => 'Your ticket has been submitted, we will be in touch ',
            ], 200);


        } catch (\Throwable $th) {
            return $this->toJson(null, 400, $th->getMessage(), false);
        }


    }

    /**


     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */

    public function one_ticket($id)
    {
        try {
            $user = Auth::user();

            $data = Ticket::with('ticket_category')->where('id', $id)
                ->where('user_id', $user->id)->get();
            $final_date= OneTicketResource::collection($data);

            return response()->json([
                "status" => true,
                "message" => __('validator.one_ticket'),
                "data"  => $final_date,
            ], 200);
          //  return responseSuccess($shipping,  __('shipping.success_shipping'));
        } catch (\Throwable $th) {
            return $this->toJson(null, 400, $th->getMessage(), false);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function StoreComment(Request $request)
    {
        $request->validate([
//            'user_id' => 'required|int|exists:users,id',
            'ticket_id' => 'nullable|int|exists:tickets,id',
            'comment_text' => 'required',
            'image' => 'image|nullable|mimes:jpeg,png,jpg|max:1024',
        ]);

        $data=$request->all();
        try {
            $user = auth()->user();

            if (isset( $data['image'])){
                $data['image'] = $data['image']->store('comment-ticket-image','public');
            }

            $comment = TicketComment::where('user_id',$user->id)->create([
                'user_id'       => $user->id,
                'author_name'   => $user->name,
                'author_email'  => $user->email,
                'ticket_id'       => $request->ticket_id,
                'comment_text'  => $request->comment_text,
                'image'  => $data['image'] ?? null ,
                'comment_type'  => 'user',
            ]);

            return response()->json([
                "status" => true,
                "message" => 'Your Comment ticket has been submitted, we will be in touch ',
            ], 200);
          //  return responseSuccess($shipping,  __('shipping.success_shipping'));
        } catch (\Throwable $th) {
            return $this->toJson(null, 400, $th->getMessage(), false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     * User Comment by ticket id
     */
    public function one_comment($ticket_id)
    {
        try {
            $user = Auth::user();
            $data = TicketComment::with('ticket')->where('ticket_id', $ticket_id)
                ->get();
//dd($data);
            $final_date= OneTicketCommentResource::collection($data);

            return response()->json([
                "status" => true,
                "message" => __('validator.one_comment'),
                "data"  => $final_date,
            ], 200);
        } catch (\Throwable $th) {
            return $this->toJson(null, 400, $th->getMessage(), false);
        }
    }
    public function close_ticket($ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id)->firstOrFail();
//                dd($ticket);

        $ticket->statues = "1";
        $ticket->save();
        return response()->json([
            "status" => true,
            "message" => 'The ticket has been closed',
//            "data"  => $ticket,
        ], 200);
      //  return redirect()->back()->with("status", "The ticket has been closed.");
    }
    public function TicketCategories()
    {
        $categories = TicketCategory::where('status',1)->get();
        $data =  TicketCategoryResource::collection($categories);
       // return $this->toJson($data);
        return response()->json([
            "status" => true,
            "message" => __('validator.TicketCategories'),
            "data"  => $data,
        ], 200);
    }
}
