<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Contracts\UserRepositoryInterface;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UsersScreen extends Screen
{

    /**
     * Get data set.
     *
     * @param \App\Contracts\UserRepositoryInterface $userRepository
     *
     * @return array<string, Collection<int, User>>
     */
    public function query(UserRepositoryInterface $userRepository): array
    {
        return [
            'users' => $userRepository->findAll()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список пользователей';
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
            Layout::table('users', [
                TD::make('id', 'ID'),
                TD::make('name', 'Логин')
                    ->sort()
                    ->cantHide(),

                TD::make('email', __('Email'))
                    ->sort()
                    ->cantHide(),

                TD::make('banned'),

                TD::make('created_at', __('Created'))
                    ->usingComponent(DateTimeSplit::class)
                    ->align(TD::ALIGN_RIGHT)
                    ->defaultHidden()
                    ->sort(),

                TD::make('updated_at', __('Last edit'))
                    ->usingComponent(DateTimeSplit::class)
                    ->align(TD::ALIGN_RIGHT)
                    ->sort(),

                TD::make('Действия')
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (User $user) => Button::make('Забанить пользователя')
                        ->confirm('Вы действительно хотите забанить этого пользователя?')
                        ->method('ban', [
                            'id' => $user->id,
                        ])),
            ])
        ];
    }

    /**
     * Ban user.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contracts\UserRepositoryInterface $userRepository
     *
     * @return void
     */
    public function ban(Request $request, UserRepositoryInterface $userRepository): void
    {
        if ($userRepository->banUserById((int) $request->get('id'))) {
            Toast::info('Пользователь забанен');
        }
        else {
            Toast::warning('Что-то пошло не так');
        }
    }

}
