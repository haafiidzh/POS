<div >
    <x-common::table.table :custom-table="$table" :datas="$datas" :sort="$sort" :order="$order" searchable>
        @forelse ($datas as $data)
            <tr>
                <x-common::table.td>{{ $data->id }}</x-common::table.td>
                @if (auth()->user()->hasRole(['Developer', 'Admin'], 'web'))
                    <x-common::table.td>{{ $data->partner->name }}</x-common::table.td>    
                @endif
                
                <x-common::table.td>{{ dateTimeTranslated($data->transaction_date) }}</x-common::table.td>
                @if ($data->payment_method == 'cash')
                    <x-common::table.td>
                        <div class="flex items-center">
                            <i class='bx bx-money text-lg text-success'></i>&nbsp;<span>Cash</span>
                        </div>
                    </x-common::table.td>
                @else
                    <x-common::table.td>
                        <div class="flex items-center">
                            <i class='bx bx-qr text-lg text-info'></i>&nbsp;<span>QRIS</span>
                        </div>
                    </x-common::table.td>
                @endif
                <x-common::table.td>Rp&nbsp;{{ number_format($data->total_amount, 0, ',', '.') }}</x-common::table.td>

                <x-common::table.td>
                    <a class="btn bg-light/75 text-slate-400 hover:bg-light hover:text-slate-600 px-2"
                    href="{{ route('administrator.transaction.show', $data->id) }}">
                        <i class="bx bx-log-in-circle"></i>
                    </a>
                </x-common::table.td>
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($table->columns) }}" class="px-4 py-4 text-center">
                    Data yang kamu cari tidak kami temukan.
                </td>
            </tr>
        @endforelse
        </tr>
    </x-common::table.table>


    {{-- <x-common::utils.remove-modal /> --}}
</div>
