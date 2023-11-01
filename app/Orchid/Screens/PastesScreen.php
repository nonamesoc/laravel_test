<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Contracts\PasteRepositoryInterface;
use App\Models\Paste;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;

class PastesScreen extends Screen
{

    /**
     * Get data set.
     *
     * @param \App\Contracts\PasteRepositoryInterface $pasteRepository
     *
     * @return array<string, Collection<int, Paste>>
     */
    public function query(PasteRepositoryInterface $pasteRepository): array
    {
        return [
            'pastes' => $pasteRepository->findAll()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список паст';
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
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('pastes', [
                TD::make('id', 'ID'),
                TD::make('title', 'Заголовок'),
                TD::make('access', 'Доступ'),
                TD::make('language', 'Язык'),
                TD::make('uri', 'Uri'),
                TD::make('text', 'Текст')->width('500')
                    ->render(function (Paste $paste) {
                    return Str::limit($paste->text, 100);
                }),
                TD::make('Действия')
                    ->width('100')
                    ->render(function (Paste $paste) {
                        return Button::make('Удалить')
                            ->method('remove')
                            ->parameters(['id' => $paste->id])
                            ->icon('bs.trash3')
                            ->confirm('Удалить эту пасту?');
                    }),
            ])
        ];
    }

    /**
     * Remove row element.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contracts\PasteRepositoryInterface $pasteRepository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request, PasteRepositoryInterface $pasteRepository): RedirectResponse
    {
        $id = (int) $request->get('id');
        $pasteRepository->delete($id);
        Alert::info('Паста удалена.');
        Toast::info('Паста удалена.');
        return redirect()->route('platform.pastes');
    }

}
