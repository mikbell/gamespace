<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GameComments extends Component
{
    public $gameSlug;
    public $authorName;
    public $content;
    public $comments = [];
    public $editingCommentId = null;

    public function mount($gameSlug)
    {
        $this->gameSlug = $gameSlug;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comment::where('game_slug', $this->gameSlug)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    public function addComment()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Devi essere autenticato per lasciare un commento.');
            return;
        }

        $this->validate([
            'content' => 'required|min:3',
            'authorName' => 'nullable|string|max:50',
        ]);

        Comment::create([
            'game_slug' => $this->gameSlug,
            'content' => $this->content,
            'author_name' => Auth::user()->name ?? 'Anonimo',
        ]);

        $this->resetFields();
        $this->loadComments();
    }

    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment) {
            $this->editingCommentId = $commentId;
            $this->content = $comment->content;
        }
    }

    public function updateComment()
    {
        if ($this->editingCommentId) {
            $this->validate(['content' => 'required|min:3']);

            $comment = Comment::find($this->editingCommentId);

        }
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment) {
            $comment->delete();
            $this->loadComments();
        }
    }
    
    private function resetFields()
    {
        $this->content = '';
        $this->authorName = '';
        $this->editingCommentId = null;
    }

    public function render()
    {
        return view('livewire.game-comments');
    }
}