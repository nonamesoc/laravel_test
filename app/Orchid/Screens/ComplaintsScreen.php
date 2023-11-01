<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Contracts\ComplaintRepositoryInterface;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ComplaintsScreen extends Screen
{

    /**
     * Get data set.
     *
     * @param \App\Contracts\ComplaintRepositoryInterface $complaintRepository
     *
     * @return array<string, Collection<int, Complaint>>
     */
    public function query(ComplaintRepositoryInterface $complaintRepository): array
    {
        return [
            'complaints' => $complaintRepository->findAll()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список жалоб';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return array<int, Table>
     */
    public function layout(): array
    {
        return [
            Layout::table('complaints', [
                TD::make('id', 'ID'),
                TD::make('user_id', 'user_id'),
                TD::make('paste_id', 'paste_id'),
                TD::make('text', 'Текст')->width('500')
                    ->render(function (Complaint $complaint) {
                        return Str::limit($complaint->text, 300);
                    }),
            ])
        ];
    }

}
