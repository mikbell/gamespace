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
    public $confirmingCommentId = null; // Per il modal di conferma

    protected $paginationTheme = 'tailwind';

    public function mount($gameSlug)
    {
        $this->gameSlug = $gameSlug;
        if (!Auth::check()) {
            session()->flash('error', 'Devi essere autenticato per visualizzare o lasciare commenti.');
        }
    }

    public function addComment()
    {
        if (!$this->isAuthenticated()) return;

        $this->validate([
            'content' => 'required|min:3',
        ]);

        Comment::create([
            'game_slug' => $this->gameSlug,
            'content' => trim($this->content),
            'user_id' => auth()->id(),
        ]);

        $this->reset('content');
        session()->flash('success', 'Commento aggiunto con successo.');
    }

    public function editComment($commentId)
    {
        if (!$this->isAuthenticated()) return;

        $comment = Comment::find($commentId);

        if ($comment && $comment->user_id === auth()->id()) { 
            $this->editingCommentId = $commentId;
            $this->content = $comment->content;
        } else {
            session()->flash('error', 'Non sei autorizzato a modificare questo commento.');
        }
    }

    public function confirmDelete($commentId)
    {
        if (!$this->isAuthenticated()) return;

        $comment = Comment::find($commentId);

        if ($comment && $comment->user_id === auth()->id()) {
            $this->confirmingCommentId = $commentId; // Imposta l'ID per confermare l'eliminazione
        } else {
            session()->flash('error', 'Non sei autorizzato a eliminare questo commento.');
        }
    }

    public function deleteComment()
    {
        if (!$this->confirmingCommentId) return;

        $comment = Comment::find($this->confirmingCommentId);

        if ($comment && $comment->user_id === auth()->id()) {
            $comment->delete();
            session()->flash('success', 'Commento eliminato con successo.');
        } else {
            session()->flash('error', 'Non sei autorizzato a eliminare questo commento.');
        }

        $this->confirmingCommentId = null; // Reset per chiudere il modal
    }

    private function isAuthenticated()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Devi essere autenticato per completare questa azione.');
            return false;
        }
        return true;
    }

    private function resetFields()
    {
        $this->reset(['content', 'editingCommentId']);
    }

    public function render()
    {
        $comments = Comment::with('user')
            ->where('game_slug', $this->gameSlug)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.game-comments', [
            'comments' => $comments,
        ]);
    }
}
