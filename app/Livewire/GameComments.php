<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class GameComments extends Component
{
    use WithPagination;

    public $gameSlug;
    public $content;
    public $editingCommentId = null;

    protected $paginationTheme = 'tailwind'; // Specifica il tema per la paginazione (opzionale)

    public function mount($gameSlug)
    {
        $this->gameSlug = $gameSlug;
    }

    public function addComment()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Devi essere autenticato per lasciare un commento.');
            return;
        }

        $this->validate([
            'content' => 'required|min:3',
        ]);

        Comment::create([
            'game_slug' => $this->gameSlug,
            'content' => trim($this->content),
            'user_id' => auth()->id(),
        ]);

        $this->resetFields();
    }

    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);

        if ($comment && $comment->user_id === auth()->id()) { 
            $this->editingCommentId = $commentId;
            $this->content = $comment->content;
        } else {
            session()->flash('error', 'Non sei autorizzato a modificare questo commento.');
        }
    }

    public function updateComment()
    {
        if ($this->editingCommentId) {
            $this->validate(['content' => 'required|min:3']);

            $comment = Comment::find($this->editingCommentId);

            if ($comment && $comment->user_id === auth()->id()) {
                $comment->update(['content' => trim($this->content)]);
                $this->resetFields();
            } else {
                session()->flash('error', 'Non sei autorizzato a modificare questo commento.');
            }
        }
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === auth()->id()) {
            $comment->delete();
        } else {
            session()->flash('error', 'Non sei autorizzato a eliminare questo commento.');
        }
    }

    private function resetFields()
    {
        $this->content = '';
        $this->editingCommentId = null;
    }

    public function render()
    {
        $comments = Comment::with('user')
            ->where('game_slug', $this->gameSlug)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Imposta il numero di commenti per pagina

        return view('livewire.game-comments', [
            'comments' => $comments,
        ]);
    }
}
