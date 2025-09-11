@php $editing = isset($izvestaj) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="zaposleni_id" label="Zaposleni" required>
            @php $selected = old('zaposleni_id', ($editing ? $izvestaj->zaposleni_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Zaposleni</option>
            @foreach($zaposlenis as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="opis"
            label="Opis"
            :value="old('opis', ($editing ? $izvestaj->opis : ''))"
            maxlength="255"
            placeholder="Opis"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="datum"
            label="Datum"
            value="{{ old('datum', ($editing ? optional($izvestaj->datum)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="tip"
            label="Tip"
            :value="old('tip', ($editing ? $izvestaj->tip : ''))"
            maxlength="255"
            placeholder="Tip"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
