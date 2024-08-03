<div class="justify-center  hidden sm:block">
    <div class="w-full grid grid-cols-12 border mt-5">
        <div class="col-span-1 flex items-center border text-center font-bold bg-white text-black">{{ __('Name') }}</div>
        <div class="col-span-11">
            <div class="flex flex-row gap-2 justify-between items-center border">
                @foreach ($rounds as $round)
                    <div class="col-span-1 gap-2 text-center text-xxs">
                        <strong>{{ $round->id }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
