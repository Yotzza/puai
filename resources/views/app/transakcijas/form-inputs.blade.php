@php $editing = isset($transakcija) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="zaposleni_id" label="Zaposleni" required>
            @php $selected = old('zaposleni_id', ($editing ? $transakcija->zaposleni_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Zaposleni</option>
            @foreach($zaposlenis as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="roba_id" label="Roba" required>
            @php $selected = old('roba_id', ($editing ? $transakcija->roba_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Roba</option>
            @foreach($robas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="kolicina"
            label="Kolicina"
            :value="old('kolicina', ($editing ? $transakcija->kolicina : ''))"
            max="255"
            placeholder="Kolicina"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="datum"
            label="Datum"
            value="{{ old('datum', ($editing ? optional($transakcija->datum)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="tip"
            label="Tip"
            :value="old('tip', ($editing ? $transakcija->tip : ''))"
            maxlength="255"
            placeholder="Tip"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
