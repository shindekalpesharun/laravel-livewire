<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    public function mount()
    {
        $this->comments = Comment::latest()->get();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'newComment' => "required|max:255|min:20"
        ]);
    }

    public function addComment()
    {
        // if ($this->newComment == '') return;

        $this->validate(['newComment' => "required|max:255"]);

        $createdComment = Comment::create(['body' => $this->newComment, 'user_id' => 1,]);
        $this->comments->prepend($createdComment);
        $this->newComment = '';
        session()->flash('message', 'Comment added Succefully!');
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete(); // delete from database
        $this->comments = $this->comments->except($commentId);  // remove from collection
        session()->flash('message', 'Comment deleted Succefully!');
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
