<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search a company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="get" action="{{ route('stocks.search') }}">
                        @csrf
                        @method('GET')
                        <label for="company">Company name:</label><br>
                        <input type="text" id="company" name="company">
                        <input type="submit" value="Search">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($company != null)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <table>
                                <tr>
                                    <th><img src="{{$company['logo']}}" alt="Logo" width="80"></th>
                                    <th>
                                        {{$company['name']}}<br>
                                        Country: {{$company['country']}}<br>
                                        Currency: {{$company['currency']}}
                                    </th>
                                </tr>

                                <tr>
                                    <td>Current price: {{$company['currentPrice']}}</td>
                                </tr>
                                <tr>
                                    <td>Current price: {{$company['highPrice']}}</td>
                                </tr>
                                <tr>
                                    <td>Current price: {{$company['lowPrice']}}</td>
                                </tr>
                                <tr>
                                    <td>Current price: {{$company['openPrice']}}</td>
                                </tr>
                        </table>
                    </div>
                    <div>
                        <form method="post" action="{{ route('stocks.purchase') }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{$company['symbol']}}">
                            <input type="hidden" value="{{$company['currentPrice']}}">
                            <label for="amount">Amount: </label>
                            <input type="number" id="amount" name="amount" min="0">
                            <input type="submit" value="Purchase">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @endif
</x-app-layout>
