<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\PasteRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PasteController extends Controller
{

    /**
     * Create class.
     *
     * @param \App\Contracts\PasteRepositoryInterface $pasteRepository
     */
    public function __construct(private PasteRepositoryInterface $pasteRepository)
    {
    }

    /**
     * Store a newly created paste in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse {
        $attributes = $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'expire_date' => 'required|in:10m,1h,3h,1d,1m,n',
            'access' => 'required|in:public,unlisted,private',
            'language' => 'required|in:php,javascript,none'
        ]);

        $attributes['user_id'] = auth()->id();
        $paste = $this->pasteRepository->createPaste($attributes);

        return redirect()
            ->route('show-paste', ['paste_uri' => $paste->uri])
            ->with('status', "Ссылка {$request->schemeAndHttpHost()}/$paste->uri");
    }

    /**
     * Display the specified paste.
     *
     * @param string $paste_uri
     *
     * @return Application|Factory|View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(string $paste_uri): Factory|View|Application {
        $paste = $this->pasteRepository->findByUri($paste_uri);
        if (!isset($paste)) {
            abort(404);
        }

        $this->authorize('view', $paste);
        return view('paste.show-paste', ['paste' => $paste]);
    }

    /**
     * Show user pastes.
     *
     * @return Application|Factory|View
     */
    public function showPastesForUser(): Factory|View|Application {
        $pastes = $this->pasteRepository->getPastesPaginationByUser(auth()->id(), 10);
        return view('paste.user-pastes', ['pastes' => $pastes]);
    }

}
