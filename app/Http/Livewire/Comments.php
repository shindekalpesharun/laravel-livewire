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

    public function addComment()
    {
        if ($this->newComment == '') return;

        $createdComment = Comment::create(['body' => $this->newComment, 'user_id' => 1,]);
        $this->comments->push($createdComment);

        // array_unshift($this->comments, [
        //     'body' => $this->newComment,
        //     'created_at' => Carbon::now()->diffForHumans(),
        //     'creator' => 'Jayesh'
        // ]);
        $this->newComment = '';
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
