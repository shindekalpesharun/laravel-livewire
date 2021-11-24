<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;
use Str;

class Comments extends Component
{
    // public $comments;
    public $newComment, $image;
    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    use WithPagination;

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }

    public function mount()
    {
        // $this->comments = Comment::latest()->paginate(2);
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
        $image = $this->storeImage();

        $createdComment = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1,
            'image' => $image,
        ]);
        // $this->comments->prepend($createdComment);
        $this->newComment = '';
        $this->image = '';
        session()->flash('message', 'Comment added Succefully!');
    }

    public function storeImage()
    {
        if (!$this->image) return null;
        return $this->$this->photo->store('photos');
        // $img = ImageManagerStatic::make($this->image)->encode('jpg');
        // $name = Str::random() . '.jpg';
        // Storage::disk('public')->put($name,$img);
        // return $name;
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete(); // delete from database
        // $this->comments = $this->comments->except($commentId);  // remove from collection
        session()->flash('message', 'Comment deleted Succefully!');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
