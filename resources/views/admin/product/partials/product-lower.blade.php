<div class="row mb-2 d-flex justify-content-start">
    <hr class="mb-0" style="color: black;">
    <div class="col-md-auto p-2">
        <p class="mb-0 fs-2 font-weight-bold" style="color: #1D0C03;">
            Reviews
        </p>
    </div>
    <div class="col-md-auto my-auto p-2" style="color: black;">
        <p class="mb-0 fs-5">
            ({{ $product->comments_count }})
        </p>
    </div>
    <div class="col-md-auto ms-auto my-auto p-2" style="color: black;">
        <div class="dropdown" style="display: {{ $comments->count() != 0 ? '' : 'none' }};">
            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
               data-bs-toggle="dropdown" aria-expanded="false">
                Sort by
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                    <a class="dropdown-item"
                       href="{{ route('admin.products.show', $product->id) . '?sortCommentBy=newest' }}">
                        Newest
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="{{ route('admin.products.show', $product->id) . '?sortCommentBy=popular' }}">
                        Popular
                    </a>
                </li>
                <li><a class="dropdown-item"
                       href="{{ route('admin.products.show', $product->id) . '?sortCommentBy=rating' }}">Rating</a>
                </li>
            </ul>
        </div>
    </div>
    <hr style="color: black;">
</div>

@foreach($comments as $comment)
    <div class="mb-5">
        <div class="row g-0 justify-content-center mx-5 px-5 mb-3">
            <div class="col-md-auto me-4">
                <img src="{{ asset('placeholders/dummy-profile-picture.png') }}" alt="...">
            </div>

            <div class="col">
                <div class="d-flex flex-row justify-content-between align-items-center mb-1">
                    <p class="mb-0 text-jh-brown fs-24-px fw-400">
                        {{ $comment->user->name }}
                    </p>

                    <p class="mb-0 text-secondary ms-auto">
                        {{ date('d/m/y', strtotime($comment->created_at)) }}
                    </p>


                </div>

                <div class="d-flex flex-row text-star">
                    @for ($i = 0; $i < 5; $i++)
                        @if (floor($comment->rating) - $i >= 1)
                            <i class="fas fa-star"></i>
                        @elseif ($comment->rating - $i > 0)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

        <div class="row g-0 mx-5 px-5">
            <p class="mb-0 text-jh-brown fs-20-px fw-700">
                {{ $comment->title }}
            </p>
        </div>

        <div class="row g-0 mx-5 px-5">
            <p class="text-secondary fw-400">
                {{ $comment->description }}
            </p>
            <img class="mb-3 comment-img" src="{{ asset('storage/comments/' . $comment->picture) }}"
                 alt="...">
        </div>

        <div class="d-flex flex-row mb-3 mx-5 px-5 align-items-center fs-7 fw-400">
            <p class="mb-0 me-4 text-secondary">
                Was this review helpful?
            </p>

            <a href="" class="text-secondary me-1" style="text-decoration: none">
                <i class="far fa-thumbs-up"></i>
            </a>

            <p class="mb-0 me-4 text-secondary">
                {{ $comment->likes->count() }}
            </p>

            <a href="" class="text-secondary me-1" style="text-decoration: none">
                <i class="far fa-thumbs-down"></i>
            </a>

            <p class="mb-0 text-secondary">
                {{ $comment->dislikes->count() }}
            </p>

            @if(auth()->check() && auth()->user()->is_admin)
                @if(!$comment->reply)
                    <button type="button" class="btn btn-sm btn-outline-secondary ms-3" id="replyButton"
                            data-bs-toggle="modal" data-bs-target="#addReplyModal"
                            data-bs-url="{{ route('admin.reply.add', $comment->id) }}">
                        Reply to this comment
                        <i class="bi bi-x-circle"></i>
                    </button>
                @endif
            @endif
        </div>

        @if($comment->reply)
            <div class="d-flex flex-row mx-5 px-5 justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 p-2 reply-card">
                        <div class="card-body text-secondary">
                            <div class="d-flex flex-row justify-content-between">
                                <p class="mb-0 fw-bold">Reply:</p>
                                @if(auth()->check() && auth()->user()->is_admin)
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-secondary" type="button"
                                           id="adminReplyActionDropdown" data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="adminReplyActionDropdown">
                                            <div class="dropdown-header py-1">
                                                <p class="mb-0 text-secondary fw-600 fs-7">Action</p>
                                            </div>
                                            <button class="dropdown-item fw-200 fs-7" id="editButton"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#updateReplyModal"
                                                    data-bs-content="{{ $comment->reply->description }}"
                                                    data-bs-url="{{ route('admin.reply.update', $comment->reply->id) }}">
                                                Edit
                                            </button>
                                            <form
                                                action="{{ route('admin.reply.delete', $comment->reply->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item fw-200 fs-7" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <p class="mb-0">
                                {{ $comment->reply->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endforeach
