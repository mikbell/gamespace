<div class="mt-6 comments-section">
    <h3 class="mb-4 text-xl font-bold">Comments</h3>

    @guest
        <p>Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> to leave a comment.</p>
    @else
        <div class="mb-4">
            <form wire:submit.prevent="{{ $editingCommentId ? 'updateComment' : 'addComment' }}">
                <div class="mb-2">
                    <textarea wire:model="content" placeholder="Scrivi un commento..."
                        class="w-full p-2 bg-gray-800 border border-gray-700 rounded-md min-h-36 max-h-36"></textarea>
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
                        <button wire:click="editComment({{ $comment->id }})"
                            class="text-blue-400 hover:underline">Modifica</button>
                        <button wire:click="confirmDelete({{ $comment->id }})"
                            class="ml-2 text-red-400 hover:underline">Elimina</button>
                    </div>
                @endif
            </div>
        @endforeach

        <!-- Paginazione -->
        {{ $comments->links() }}

        <!-- Modal di Conferma Eliminazione -->
        @if ($confirmingCommentId)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                <div class="w-full max-w-sm p-6 bg-gray-900 border border-gray-800 rounded-lg shadow-lg">
                    <h2 class="mb-4 text-lg font-semibold">Conferma Eliminazione</h2>
                    <p>Sei sicuro di voler eliminare questo commento? Questa azione non può essere annullata.</p>

                    <div class="flex justify-end mt-4 space-x-4">
                        <button wire:click="$set('confirmingCommentId', null)"
                            class="px-4 py-2 text-black transition duration-150 ease-in-out bg-gray-300 rounded-md hover:bg-gray-400">Annulla</button>
                        <button wire:click="deleteComment"
                            class="px-4 py-2 text-white transition duration-150 ease-in-out bg-red-500 rounded-md hover:bg-red-700">Elimina</button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('pageChanged', () => {
            const commentsSection = document.querySelector('.comments-section');
            if (commentsSection) {
                commentsSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
