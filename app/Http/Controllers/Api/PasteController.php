<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\PasteRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\PasteResource;
use App\Policies\PastePolicy;
use Illuminate\Http\JsonResponse;
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse {
        $attributes = $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'expire_date' => 'required|in:10m,1h,3h,1d,1m,n',
            'access' => 'required|in:public,unlisted,private',
            'language' => 'required|in:php,javascript,none'
        ]);

        $attributes['user_id'] = auth('sanctum')->id();
        $paste = $this->pasteRepository->createPaste($attributes);

        return response()->json(new PasteResource($paste));
    }

    /**
     * Display the specified paste.
     *
     * @param string $paste_uri
     * @param \App\Policies\PastePolicy $policy
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $paste_uri, PastePolicy $policy): JsonResponse {
        $paste = $this->pasteRepository->findByUri($paste_uri);
        if (!isset($paste)) {
            return response()->json([
                'message' => 'Не найдено'
            ], 404);
        }

        /** @var \App\Models\User $user */
        $user = auth('sanctum')->user();
        if (!$policy->view($user, $paste)) {
            return response()->json([
                'message' => 'Недоступно'
            ], 403);
        }

        return response()->json(new PasteResource($paste));
    }

    /**
     * Show recent pastes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRecentPastes(): JsonResponse {
        $pastes = $this->pasteRepository->getRecentPastes();
        return response()->json(PasteResource::collection($pastes));
    }

    /**
     * Show recent user pastes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showRecentUserPastes(): JsonResponse {
        $pastes = $this->pasteRepository->getRecentPastesByUser(auth()->id());
        return response()->json(PasteResource::collection($pastes));
    }

    /**
     * Show user pastes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showPastesForUser(): JsonResponse {
        $pastes = $this->pasteRepository->getPastesPaginationByUser(auth()->id());
        return response()->json($pastes);
    }

}
