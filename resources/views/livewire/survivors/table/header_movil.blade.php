<div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
    <div class="w-full grid grid-cols-12 border">
        <div class="col-span-2 flex items-center text-center font-bold ">{{ __('Name') }}</div>
        <div class="col-span-9">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($rounds as $round)
                    <div class="col-span-1 gap-2 text-xxs">
                        {{  $round->id }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
