<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stocks you own') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table style="width:70%">
                        <tr>
                        <th>Company</th>
                        <th>Amount</th>
                        </tr
                        @foreach($stock as $record)
                            <tr>
                                <td style="text-align: center">{{$record->getName()}}</td>
                                <td style="text-align: center">{{$record->getAmount()}}</td>
                                <td>
                                    <form method="post" action="{{ route('owned.sell') }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{$record->getID()}}">
                                        <input type="hidden" name="price" value="{{$record->getPurchasedFor()}}">
                                        <input type="number" name="amount" min="0" max="{{$record->getAmount()}}" style="width: 15%">
                                        <input type="submit" value="Sell">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
