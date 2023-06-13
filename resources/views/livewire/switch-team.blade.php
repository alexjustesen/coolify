<div class="w-64 -mt-9">
    <x-forms.select wire:model="selectedTeamId">
        <option value="default" disabled selected>Switch team</option>
        @foreach (auth()->user()->teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </x-forms.select>
</div>