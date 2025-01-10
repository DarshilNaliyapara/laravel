<?php

namespace App\Http\Controllers;
use App\Models\Chirp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Reply;
use Illuminate\Http\Response; 



class ReplyController extends Controller
{
    public function storereply(Request $request, Chirp $chirp): RedirectResponse
    {
      
        $validated = $request->validate([
            'replies' => 'required|string|max:255',
        ]);
       
      
        $chirp->replies()->create([
            'replies' => $validated['replies'],
            'user_id' => auth()->id(),
           'chirp_id' => $chirp->id
        ]);
        
      
        return redirect(route('chirps.index'));
    }
    public function reply(Chirp $chirp):View
    {
       
        return view('chirps.reply', compact('chirp'));
    }
    public function destroyreply(Reply $reply):RedirectResponse
    {
      

        $reply->delete();
 
        return redirect(route('chirps.index'));
    }
}
