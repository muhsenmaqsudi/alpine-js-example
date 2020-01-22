@extends('master')

@section('content')

    <div class="flex">
        <div class="w-1/6 p-2 border-4 border-gray-200" x-data="{ open: false }">
            <button @click="open = true"
                    class="bg-blue-400 p-2 rounded-lg shadow-lg hover:bg-blue-300 active:bg-blue-500 focus:outline-none focus:shadow-outline">
                Open Dropdown
            </button>

            <ul
                x-show="open"
                @click.away="open = false"
            >
                Dropdown Body
            </ul>
        </div>

        <div class="w-1/6 p-2 border-4 border-gray-200" x-data="{ tab: 'foo' }">
            <button :class="{ 'active': tab === 'foo' }" @click="tab = 'foo'">Foo</button>
            <button :class="{ 'active': tab === 'bar' }" @click="tab = 'bar'">Bar</button>

            <div x-show="tab === 'foo'">Tab Foo</div>
            <div x-show="tab === 'bar'">Tab Bar</div>
        </div>
        <div class="w-1/6 p-2 border-4 border-gray-200 overflow-scroll w-1/ " x-data="{ tab: 'foo' }">
            <div x-data="{ open: false }">
                <button
                    @click.once="
                        fetch('https://api.myjson.com/bins/9dsue')
                            .then(response => response.text())
                            .then(html => { $refs.dropdown.innerHTML = html })
                    "
                    @click="open = true"
                >Show Dropdown
                </button>

                <div x-ref="dropdown" x-show="open" @click.away="open = false">
                    Loading Spinner...
                </div>
            </div>
        </div>
        <div class="w-1/6 p-2 border-4 border-gray-200">
            <div x-data='{ provinceId: "", cityId: "", cities: []}'>
                <select x-model="provinceId"
                        @change="fetch(`cities/${provinceId}`)
                            .then(response => response.json())
                            .then(response =>  cities = response)"
                >
                    <option>Select province</option>
                    @foreach($cities as $city)
                        <option value="{{ $city['id']  }}">
                            {{ $city['name'] }}
                        </option>
                    @endforeach
                </select>
                <select x-model="cityId">
                    <template x-for="city in cities" :key="city.id">
                        <option :value="city.id" x-text="city.name"></option>
                    </template>
                </select>
            </div>
        </div>
    </div>
@endsection

