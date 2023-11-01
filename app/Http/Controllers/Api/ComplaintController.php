<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ComplaintRepositoryInterface;
use App\Contracts\PasteRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Policies\PastePolicy;
use Illuminate\Http\JsonResponse;
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
     * Store a newly created complaint in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $paste_uri
     * @param \App\Policies\PastePolicy $policy
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, string $paste_uri, PastePolicy $policy): JsonResponse {
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

        $attributes = $this->validate($request, [
            'text' => 'required',
        ]);

        $attributes['user_id'] = auth('sanctum')->id();
        $attributes['paste_id'] = $paste->id;
        $complaint = $this->complaintRepository->createComplaint($attributes);

        return response()->json(['message' => 'Жалоба отправлена.']);
    }

}
