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
        <div class="w-1/6 p-2 border-4 border-gray-200 overflow-scroll" x-data="{ tab: 'foo' }">
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
        <div class="w-1/6 p-2 border-4 border-gray-200 overflow-scroll" x-data="{ tab: 'foo' }">
            <div x-data='{ city: "", cities: []}'>
                <select x-model="city"
                        @change="fetch(`cities/${city}`)
                            .then(response => response.text())
                            .then(response => cities = response)
                        "
                >
                    @foreach($cities as $city)
                        <option
                            value="{{ $city['id']  }}"
                        >{{ $city['name']  }}</option>
                    @endforeach
                </select>
                <div x-text="cities"></div>
                <template x-if="cities">
                    <select name="">
                        <template x-for="item in cities" :key="item">
                            <option value="" x-text="item.name"></option>
                        </template>
                    </select>
                </template>
            </div>


                <div x-data='{ cities: [
                        {
                            "id":5,
                            "name":
                            "Karaj",
                            "parent_id":2,
                            "created_at":"2020-01-22 11:29:10",
                            "updated_at":"2020-01-22 11:29:17"
                        },
                        {
                            "id":6,
                            "name":"Mehrshahr",
                            "parent_id":2,
                            "created_at":"2020-01-22 11:29:10",
                            "updated_at":"2020-01-22 11:29:17"
                        }
                    ]
                }'>
                    <select>
                        <template x-for="item in cities" :key="item">
                            <option value="" x-text="item.name"></option>
                        </template>
                    </select>
                </div>
            </div>
        </div>

    </div>


@endsection

<div x-data='{ provinceId: "", cityId: "" ,cities: []}'>
    <select x-model="provinceId"
            @change="fetch(`cities/${provinceId}`)
                            .then(response => response.text())
                            .then(response => cities = response)
                        "
    >
        @foreach($cities as $city)
            <option
                value="{{ $city['id']  }}"
            >{{ $city['name']  }}</option>
        @endforeach
    </select>
    <div x-text="cities"></div>
    <select x-model="cityId">
        <template x-for="city in cities" :key="city">
            <option value="" x-text="city.name"></option>
        </template>
    </select>
</div>
