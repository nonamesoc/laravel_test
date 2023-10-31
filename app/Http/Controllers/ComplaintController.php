<?php

namespace App\Http\Controllers;

use App\Contracts\ComplaintRepositoryInterface;
use App\Contracts\PasteRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{

    /**
     * Create class.
     *
     * @param \App\Contracts\PasteRepositoryInterface $pasteRepository
     * @param \App\Contracts\ComplaintRepositoryInterface $complaintRepository
     */
    public function __construct(private PasteRepositoryInterface $pasteRepository,
                                private ComplaintRepositoryInterface $complaintRepository)
    {
    }

    /**
     * Show the form for creating a complaint.
     *
     * @param string $paste_uri
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(string $paste_uri): Factory|View|Application {
        $paste = $this->pasteRepository->findByUri($paste_uri);
        if (!isset($paste)) {
            abort(404);
        }

        $this->authorize('view', $paste);

        return view('complaint.create-complaint', ['paste' => $paste]);
    }

    /**
     * Store a newly created complaint in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $paste_uri
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, string $paste_uri): RedirectResponse {
        $paste = $this->pasteRepository->findByUri($paste_uri);
        if (!isset($paste)) {
            abort(404);
        }

        $this->authorize('view', $paste);
        $attributes = $this->validate($request, [
            'text' => 'required',
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['paste_id'] = $paste->id;
        $complaint = $this->complaintRepository->createComplaint($attributes);

        return redirect()
            ->route('show-paste', ['paste_uri' => $paste->uri])
            ->with('status', "Жалоба отправлена");
    }

}
