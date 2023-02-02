<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form name="as" method="POST" action="{{route('contacto.procesar')}}">

                @csrf
                <div class="mx-auto w-1/2 bg-gray-200 rounded-xl shadow-lg px-2 py-4">
                    <x-jet-label class="mt-2">Nombre</x-jet-label>
                    <x-jet-input name="nombre" type="text" placeholder="Introduce tu nombre..." value="{{old('nombre')}}" class="w-full mt-2"></x-jet-input>
                    <x-jet-input-error for="nombre"></x-jet-input-error>

                    <x-jet-label class="mt-2">Email</x-jet-label>
                    <x-jet-input name="email" type="email" placeholder="Introduce tu email..." value="{{old('email')}}" class="w-full mt-2"></x-jet-input>
                    <x-jet-input-error for="email"></x-jet-input-error>

                    <x-jet-label class="mt-2">Contenido</x-jet-label>
                    <textarea name="contenido" rows="4" placeholder="Introduce el contenido..." value="{{old('contenido')}}" class="w-full mt-2"></textarea>
                    <x-jet-input-error for="contenido"></x-jet-input-error>

                    <div class="mt-2 flex flex-row-reverse">
                        
                        <button type="submit" class="mb-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="mr-2 fa-solid fa-paper-plane"></i>Enviar
                        </button>

                        <a href="{{route('dashboard')}}" class="mr-2 mb-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            <i class="mr-2 fas fa-xmark"></i>Cancelar
                        </a>
                    </div>

            </form>

        </div>
    </div>

</x-app-layout>