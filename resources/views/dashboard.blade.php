<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <div class="flex flex-row-reverse">
                                <a href="{{ route('articles.create') }}"
                                    class="mb-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    <i class="fas fa-add"></i> Nuevo
                                </a>
                            </div>
                            @if ($articles->count())
                                <table class="min-w-full">
                                    <thead class="bg-white border-b">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left font-bold">
                                                INFO
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left font-bold">
                                                NOMBRE
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left font-bold">
                                                STOCK
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left font-bold">
                                                ACCIONES
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $item)
                                            <tr class="bg-gray-100 border-b">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <a href="{{ route('articles.showNoAuth', $item) }}"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        <i class="fas fa-info"></i>
                                                    </a>
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $item->nombre }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $item->stock }}
                                                </td>
                                                <td
                                                    class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    <form name="as" method="POST"
                                                        action="{{ route('articles.destroy', $item) }}">

                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('articles.edit', $item) }}"
                                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="submit"
                                                            class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2">
                                    {{ $articles->links() }}
                                </div>
                            @else
                                <p
                                    class="text-sm md:text-base bg-green-200 h-8 py-1 mx-auto px-3 w-2/5 font-bold rounded">
                                    Aún no has registrado ningún artículo, ¡ahora es tú momento!</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>
