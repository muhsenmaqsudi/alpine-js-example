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
            <div x-data="{ open: false, city: '', cities: [], faqs: [
                        {
                            question: 'Why do I need Alpine JS?',
                            answer: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores iure quas laudantium dicta impedit, est id delectus molestiae deleniti enim nobis rem et nihil. Magni consequuntur, suscipit voluptates, dolorem ut deserunt laboriosam repudiandae, alias vero minima delectus iure quasi id earum reiciendis est culpa autem commodi sed nisi hic. Impedit?',
                            isOpen: false,
                        },
                        {
                            question: 'Why am I so awesome?',
                            answer: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi cumque, nulla harum aspernatur veniam ullam provident neque temporibus autem itaque odit modi magnam fuga eius quidem vel dolor non, aperiam hic, porro possimus veritatis numquam et! Animi nihil dolorem in, quis harum possimus numquam incidunt reprehenderit repellendus, maxime ut, nulla.',
                            isOpen: false,
                        },
                    ] }">
                <select x-model="city"
                        @change="fetch(`/cities/${city}`)
                            .then(response => response.text())
                            .then(response => cities = response)
                            .then(cities => console.log(cities))
{{--                            .then(html => { $refs.city.innerHTML = html })--}}
                        "
                >
                    @foreach($cities as $city)
                        <option
                            value="{{ $city['id']  }}"
                        >{{ $city['name']  }}</option>
                    @endforeach
                </select>

                <template x-for="city in cities" :key="city">
                    <p x-text="city.name"></p>
                    <div x-text="cities"></div>
                </template>
            </div>
        </div>
    </div>


@endsection
