@php $editing = isset($zaposleni) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ime"
            label="Ime"
            :value="old('ime', ($editing ? $zaposleni->ime : ''))"
            maxlength="255"
            placeholder="Ime"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="username"
            label="Username"
            :value="old('username', ($editing ? $zaposleni->username : ''))"
            maxlength="255"
            placeholder="Username"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>
</div>
