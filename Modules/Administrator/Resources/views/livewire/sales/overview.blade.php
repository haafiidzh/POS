<div x-data="{ showOrderModal: false }">
    <div class="w-1/5 absolute p-4">
        <livewire:common::utils.daterange-picker :value="$dates" />
    </div>
    <livewire:administrator::sales.table :dates="$dates" />
</div>