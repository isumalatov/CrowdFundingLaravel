@if ($comments->count() > 0)
    <ul>
        @foreach ($comments as $comment)
            <li>
                {{ $comment->user->name }}: {{ $comment->text }}
                @if (Auth::user()->isSuper)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                @endif
                <button type="button" class="btn btn-link btn-sm" onclick="toggleReplies({{ $comment->id }})">Ver hilo</button>
                <div id="replies-{{ $comment->id }}" style="display: none; margin-left: 20px;">
                    @include('projects.partials.replies', ['comments' => $comment->replies])
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $comment->project_id }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div class="form-group">
                            <label for="reply-{{ $comment->id }}">Respuesta:</label>
                            <textarea name="text" id="reply-{{ $comment->id }}" class="form-control" rows="2" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Responder</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endif
