<div>

    <div class="flex flex-col col-span-1 border items-center justify-start border-black">
        @for ($i = 1; $i < 2; $i++)
            <span class="block mt-2">&nbsp;</span>
        @endfor
        {{ $general_hits }}
        @for ($i = 1; $i < 2; $i++)
            <span class="block">&nbsp;</span>
        @endfor
    </div>
</div>
