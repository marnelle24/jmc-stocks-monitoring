<div>
    {{-- @json($selectedCat) --}}
    <select wire:model.live.debounce.500ms="selectedCat" class="p-0 min-h-[350px] shadow-md capitalize w-full border-zinc-200 focus:border-zinc-200 focus:ring-0 focus:outline-none" multiple>
        @foreach ($categories as $key => $cat )
            <option wire:key="{{$key}}" class="border-t py-3 px-2" value="{{$key}}">{{$cat}}</option>
        @endforeach
    </select>
</div>