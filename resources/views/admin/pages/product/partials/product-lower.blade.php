<div class="row mb-2 d-flex justify-content-start">
    <hr class="mb-0" style="color: black;">
    <div class="col-md-auto p-2">
        <p class="mb-0 fs-2 font-weight-bold" style="color: #1D0C03;">
            Reviews
        </p>
    </div>
    <div class="col-md-auto my-auto p-2" style="color: black;">
        <p class="mb-0 fs-5">
            ({{ $product->comments->count() }})
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
    <div class="row mb-3 d-flex justify-content-center">
        <div class="col-md-10">
            <div class="row mb-3 d-flex justify-content-start">
                <div class="col-md-auto my-auto">
                    <img src="{{ asset('placeholders/dummy-profile-picture.png') }}" alt="...">
                </div>
                <div class="col-md-auto">
                    <div class="row">
                        <p class="mb-0 fs-5" style="color: #2E190D; font-weight: 400;">
                            {{ $comment->user->name }}
                        </p>
                    </div>
                    <div class="row">
                        <div class="col" style="color: #FFB700">
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
                <div class="col-md-auto ms-auto">
                    <p class="text-secondary mb-0">
                        {{ date('d/m/y', strtotime($comment->created_at)) }}
                    </p>
                </div>
            </div>

            <div class="row">
                <p class="mb-0 fs-5 font-weight-bold" style="color: #2E190D;">
                    This bag is perfect for me
                </p>
                <p class="text-secondary">
                    I was really pleased when I got this in the mail. It’s just as cute as the picture shows, well-made
                    And a nice lining. I hear compliments on it everywhere I go. The only one little thing about it that
                    was a deterrent at first was that it does not open up very wide, but I’ve gotten used to that now.
                    Also make snap the snaps all the way to cloRead more about review stating I LOVE THIS BAG!se
                    otherwise things will fall out of your bag. I bought another for my girlfriend for her birthday And
                    she loved it too. Also, the shipment was really quick and packaged really, really nice with a little
                    bag. Definitely recommend this line.
                </p>
                <img class="mb-3" src="{{ asset('placeholders/review-1.png') }}" alt="..."
                     style="width: 180px; height: auto;">
            </div>

            <div class="row justify-content-start text-secondary fs-6 mb-3">
                <div class="col-md-auto my-auto">
                    <p class="mb-0">Was this review helpful?</p>
                </div>
                <div class="col-md-auto pr-2 my-auto">
                    <a href="" class="text-secondary" style="text-decoration: none">
                        <i class="far fa-thumbs-up"></i>
                    </a>
                </div>
                <div class="col-md-auto pl-0 pr-2 my-auto">
                    {{ $comment->likes->count() }}
                </div>
                <div class="col-md-auto pr-2 pl-2 my-auto">
                    <a href="" class="text-secondary" style="text-decoration: none">
                        <i class="far fa-thumbs-down"></i>
                    </a>
                </div>
                <div class="col-md-auto pl-0 pr-2 my-auto">
                    {{ $comment->dislikes->count() }}
                </div>
                <div class="col-md-auto pl-2">
                    @if(!$comment->reply)
                        <button type="button" class="btn btn-sm btn-outline-secondary" id="replyButton"
                                data-bs-toggle="modal" data-bs-target="#addReplyModal"
                                data-bs-url="{{ route('admin.reply.add', $comment->id) }}">
                            Reply to this comment
                            <i class="bi bi-x-circle"></i>
                        </button>
                    @endif
                </div>

                @if($comment->reply)
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-10">
                            <div class="card border-0 p-2"
                                 style="background: rgba(204, 169, 148, 0.26); border-radius: 5px;">
                                <div class="card-body">
                                    <div class="row justify-content-between">
                                        <div class="col-md-auto">
                                            <p class="mb-0">Reply:</p>
                                        </div>
                                        <div class="col-md-auto">
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-secondary"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                     aria-labelledby="dropdownMenuLink">
                                                    <div class="dropdown-header">Action</div>
                                                    <button class="dropdown-item" id="editButton" data-bs-toggle="modal"
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
                                                        <button class="dropdown-item" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="mb-0">
                                            {{ $comment->reply->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endforeach
