<div class="mt-6 comments-section">
    <h3 class="mb-4 text-xl font-bold">Commenti</h3>

    @guest
        <p class="text-gray-700">Devi <a href="{{ route('login') }}" class="text-blue-500">accedere</a> per lasciare un commento.</p>
    @else
        <div class="mb-4">
            <form wire:submit.prevent="{{ $editingCommentId ? 'updateComment' : 'addComment' }}">
                <div class="mb-2">
                    <textarea wire:model="content" placeholder="Scrivi un commento..." class="w-full p-2 bg-gray-800 border border-gray-700 rounded-md min-h-36 max-h-36"></textarea>
                    @error('content')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">
                    {{ $editingCommentId ? 'Aggiorna' : 'Invia' }}
                </button>
            </form>
        </div>
    @endguest

    <div class="comments-list">
        @foreach ($comments as $comment)
            <div class="p-4 mb-4 bg-gray-900 rounded-md">
                <p class="font-semibold">{{ $comment->user->name }}</p>
                <p class="mt-2">{{ $comment->content }}</p>
                <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>

                @if (Auth::check() && Auth::id() === $comment->user_id)
                    <div class="mt-2">
                        <button wire:click="editComment({{ $comment->id }})" class="text-blue-400 hover:underline">Modifica</button>
                        <button wire:click="deleteComment({{ $comment->id }})" class="ml-2 text-red-400 hover:underline">Elimina</button>
                    </div>
                @endif
            </div>
        @endforeach

        <div class="mt-4">
            {{ $comments->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('pageChanged', () => {
            const commentsSection = document.querySelector('.comments-section');
            if (commentsSection) {
                commentsSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>