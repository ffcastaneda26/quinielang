<div class="mt-5">
    @livewire('select-round')
    <div class="flex justify-center mt-2">
        <div class="d-flex justify-content-center text-center mt-2 mb-4">
            {{-- <table class="table-auto">
                <thead>
                    <tr>
                        <th class="bg-black text-white font-bold">Fecha</th>
                        <th class="bg-black text-white font-bold">Visita</th>
                        <th class="bg-black text-white font-bold">&nbsp;</th>
                        <th class="bg-black text-white font-bold">Pronóstico</th>
                        <th class="bg-black text-white font-bold">&nbsp;</th>
                        <th class="bg-black text-white font-bold">Local</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($round_games as $game)
                        <tr>
                            <td>{{ $game->game_date->format('d M Y h:i') }}</td>
                            <td>{{ $game->visit_team->name }}</td>
                            <td>{{ $game->winner }}</td>
                            <td>{{ $game->local_team->name }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table> --}}
            <table role="table" class="w-full min-w-[500px] overflow-x-scroll">
                <thead>
                <tr role="row">
                    <th
                    colspan="1"
                    role="columnheader"
                    title="Toggle SortBy"
                    style="cursor: pointer"
                    >
                    <div
                        class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs"
                    >
                        Name
                    </div>
                    </th>
                    <th
                    colspan="1"
                    role="columnheader"
                    title="Toggle SortBy"
                    style="cursor: pointer"
                    >
                    <div
                        class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs"
                    >
                        Artworks
                    </div>
                    </th>
                    <th
                    colspan="1"
                    role="columnheader"
                    title="Toggle SortBy"
                    style="cursor: pointer"
                    >
                    <div
                        class="flex items-center justify-between pb-2 pt-4 text-start uppercase tracking-wide text-gray-600 sm:text-xs lg:text-xs"
                    >
                        Rating
                    </div>
                    </th>
                </tr>
                </thead>
                <tbody role="rowgroup" class="px-4">
                <tr role="row">
                    <td class="py-3 text-sm" role="cell">
                    <div class="flex items-center gap-2">
                        <div class="h-[30px] w-[30px] rounded-full">
                        <img
                            src="https://images.unsplash.com/photo-1506863530036-1efeddceb993?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=2244&amp;q=80"
                            class="h-full w-full rounded-full"
                            alt=""
                        />
                        </div>
                        <p
                        class="text-sm font-medium text-navy-700 dark:text-white"
                        >
                        @maddison_c21
                        </p>
                    </div>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <p class="text-md font-medium text-gray-600 dark:text-white">
                        9821
                    </p>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <div class="mx-2 flex font-bold">
                        <div
                        class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700"
                        >
                        <div
                            class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                            style="width: 30%"
                        ></div>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr role="row">
                    <td class="py-3 text-sm" role="cell">
                    <div class="flex items-center gap-2">
                        <div class="h-[30px] w-[30px] rounded-full">
                        <img
                            src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1780&amp;q=80"
                            class="h-full w-full rounded-full"
                            alt=""
                        />
                        </div>
                        <p
                        class="text-sm font-medium text-navy-700 dark:text-white"
                        >
                        @karl.will02
                        </p>
                    </div>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <p class="text-md font-medium text-gray-600 dark:text-white">
                        7032
                    </p>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <div class="mx-2 flex font-bold">
                        <div
                        class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700"
                        >
                        <div
                            class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                            style="width: 30%"
                        ></div>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr role="row">
                    <td class="py-3 text-sm" role="cell">
                    <div class="flex items-center gap-2">
                        <div class="h-[30px] w-[30px] rounded-full">
                        <img
                            src="https://images.unsplash.com/photo-1573766064535-6d5d4e62bf9d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1315&amp;q=80"
                            class="h-full w-full rounded-full"
                            alt=""
                        />
                        </div>
                        <p
                        class="text-sm font-medium text-navy-700 dark:text-white"
                        >
                        @andreea.1z
                        </p>
                    </div>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <p class="text-md font-medium text-gray-600 dark:text-white">
                        5204
                    </p>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <div class="mx-2 flex font-bold">
                        <div
                        class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700"
                        >
                        <div
                            class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                            style="width: 30%"
                        ></div>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr role="row">
                    <td class="py-3 text-sm" role="cell">
                    <div class="flex items-center gap-2">
                        <div class="h-[30px] w-[30px] rounded-full">
                        <img
                            src="https://images.unsplash.com/photo-1628157588553-5eeea00af15c?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1780&amp;q=80"
                            class="h-full w-full rounded-full"
                            alt=""
                        />
                        </div>
                        <p
                        class="text-sm font-medium text-navy-700 dark:text-white"
                        >
                        @abraham47.y
                        </p>
                    </div>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <p class="text-md font-medium text-gray-600 dark:text-white">
                        4309
                    </p>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <div class="mx-2 flex font-bold">
                        <div
                        class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700"
                        >
                        <div
                            class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                            style="width: 30%"
                        ></div>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr role="row">
                    <td class="py-3 text-sm" role="cell">
                    <div class="flex items-center gap-2">
                        <div class="h-[30px] w-[30px] rounded-full">
                        <img
                            src="https://i.ibb.co/7p0d1Cd/Frame-24.png"
                            class="h-full w-full rounded-full"
                            alt=""
                        />
                        </div>
                        <p
                        class="text-sm font-medium text-navy-700 dark:text-white"
                        >
                        @simmmple.web
                        </p>
                    </div>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <p class="text-md font-medium text-gray-600 dark:text-white">
                        3871
                    </p>
                    </td>
                    <td class="py-3 text-sm" role="cell">
                    <div class="mx-2 flex font-bold">
                        <div
                        class="h-2 w-16 rounded-full bg-gray-200 dark:bg-navy-700"
                        >
                        <div
                            class="flex h-full items-center justify-center rounded-md bg-brand-500 dark:bg-brand-400"
                            style="width: 30%"
                        ></div>
                        </div>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-fluid mt-2">
        @if (isset($round_games))
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="mb-0 table table-striped table-hover text-xs">
                                    @include('livewire.picks.header_table')
                                </table>
                            </div>
                            @foreach ($round_games as $game)
                                {{-- @livewire('picks.pick-game',
                                            ['game' => $game,
                                             'id_game_tie_breaker' => $id_game_tie_breaker,
                                             'configuration' => $configuration],
                                            key($game->id)) --}}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
