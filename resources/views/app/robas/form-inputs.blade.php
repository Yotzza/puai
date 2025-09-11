@php $editing = isset($roba) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="naziv"
            label="Naziv"
            :value="old('naziv', ($editing ? $roba->naziv : ''))"
            maxlength="255"
            placeholder="Naziv"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="sifra"
            label="Sifra"
            :value="old('sifra', ($editing ? $roba->sifra : ''))"
            maxlength="255"
            placeholder="Sifra"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="opis"
            label="Opis"
            :value="old('opis', ($editing ? $roba->opis : ''))"
            maxlength="255"
            placeholder="Opis"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="kolicina"
            label="Kolicina"
            :value="old('kolicina', ($editing ? $roba->kolicina : ''))"
            max="255"
            placeholder="Kolicina"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="lokacija"
            label="Lokacija"
            :value="old('lokacija', ($editing ? $roba->lokacija : ''))"
            maxlength="255"
            placeholder="Lokacija"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
