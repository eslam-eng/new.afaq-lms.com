<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TicketsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = Ticket::with(['user', 'ticket_category', 'media'])->get();

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        abort_if(Gate::denies('ticket_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::where('approved',1)->where('verified',1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = TicketCategory::where('status',1)->pluck('title_'.app()->getLocale(), 'id')
           ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tickets.create', compact('categories', 'users'));
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create($request->all());

//        if ($request->input('image', false)) {
//            $ticket->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('AdminTicketimage');
//        }
//
//        if ($media = $request->input('ck-media', false)) {
//            Media::whereIn('id', $media)->update(['model_id' => $ticket->id]);
//        }
        if (isset( $data['image'])){
            $data['image'] = $data['image']->store('AdminTicketimage','public');
        }

        return redirect()->route('admin.tickets.index');
    }

    public function edit(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::where('approved',1)->where('verified',1)->paginate(10)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = TicketCategory::where('status',1)
            ->pluck('title_'.app()->getLocale(), 'id')->prepend(trans('global.pleaseSelect'), '');

        $ticket->load('user', 'ticket_category');

        return view('admin.tickets.edit', compact('categories' ,'ticket', 'users'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->all());

//        if ($request->input('image', false)) {
//            if (! $ticket->image || $request->input('image') !== $ticket->image->file_name) {
//                if ($ticket->image) {
//                    $ticket->image->delete();
//                }
//                $ticket->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
//            }
//        } elseif ($ticket->image) {
//            $ticket->image->delete();
//        }
        if (isset( $data['image'])){
            $data['image'] = $data['image']->store('AdminTicketimage','public');
        }

        return redirect()->route('admin.tickets.index');
    }

    public function show(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $ticket->load('user',  'ticket_category','ticket_comments','ticket_business_comments');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->delete();

        return back();
    }

    public function massDestroy(MassDestroyTicketRequest $request)
    {
        $tickets = Ticket::find(request('ids'));

        foreach ($tickets as $ticket) {
            $ticket->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ticket_create') && Gate::denies('ticket_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ticket();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function storeComment(Request $request, Ticket $ticket)
    {
//dd($ticket->id);
        $request->validate([
            'ticket_id' => 'nullable|int|exists:tickets,id',
            'comment_text' => 'required',
            'image' => 'image|nullable|mimes:jpeg,png,jpg|max:1024',
        ]);

        $user = auth()->user();

        $comment = $ticket->ticket_comments()->create([
            'author_name'   => $user->name,
            'author_email'  => $user->email,
            'user_id'       => $user->id,
            'comment_text'  => $request->comment_text,
            'ticket_id'       => $ticket->id,
            'image'  => $request->image,
            'comment_type'  => 'admin',


        ]);

        if (isset( $data['image'])){
            $data['image'] = $data['image']->store('comment-ticket-image','public');
        }

       // $ticket->sendCommentNotification($comment);

        return redirect()->back()->withStatus('Your comment added successfully');
    }
    public function userTickets($ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id);

        //$tickets = Ticket::where('user_id', auth()->user())->paginate(10);
        //return view('tickets.user_tickets', compact('tickets',$ticket));
        return view('frontend.personalInfos.mytickets',compact('ticket'));

    }
    public function close_ticket($ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id)->firstOrFail();
        $ticket->statues = "1";
        $ticket->save();

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
    /**
     * Afaq Business Comment
     */
    public function storeBusinessComment(Request $request, Ticket $ticket)
    {

        $request->validate([
            'ticket_id' => 'nullable|int|exists:tickets,id',
            'comment_text' => 'required',
            'image' => 'image|nullable|mimes:jpeg,png,jpg|max:1024',
        ]);

        $user = auth()->user();

//        $comment = $ticket->ticket_business_comments()->create([


            $image = $request['image']->store('business_comment-ticket-image','public');

        $comment = $ticket->ticket_comments()->create([
            'author_name'   => $user->name,
            'author_email'  => $user->email,
            'user_id'       => $user->id,
            'comment_text'  => $request->comment_text,
            'ticket_id'       => $ticket->id,
            'image'  =>$image,
            'comment_type'  => 'admin',
            'type'  => 'Business',

        ]);


        // $ticket->sendCommentNotification($comment);

        return redirect()->back()->withStatus('Your comment added successfully');
    }
}
