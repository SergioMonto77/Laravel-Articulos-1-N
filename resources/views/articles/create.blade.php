<x-app-layout> {{--implemento la plantilla 'app'--}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form name="as" method="POST" action="{{route('articles.store')}}" enctype="multipart/form-data"> {{--DEBO INDICAR EL ENCTYPE (ya que voy a subir archivos)--}}
                
                @csrf
                <div class="mx-auto w-1/2 bg-gray-200 rounded-xl shadow-lg px-2 py-4">
                    <x-jet-label class="mt-2">Nombre</x-jet-label>
                    <x-jet-input name="nombre" type="text" placeholder="Introduce el nombre..." value="{{old('nombre')}}" class="w-full mt-2"></x-jet-input>
                    <x-jet-input-error for="nombre"></x-jet-input-error>

                    <x-jet-label class="mt-2">Descripción</x-jet-label>
                    <textarea name="descripcion" placeholder="Introduce una descripción..." rows="4" class="w-full mt-2">{{old('descripcion')}}</textarea>
                    <x-jet-input-error for="descripcion"></x-jet-input-error>

                    <x-jet-label class="mt-2">Precio</x-jet-label>
                    <x-jet-input name="precio" type="number" step="0.01" placeholder="Introduce el precio..." value="{{old('precio')}}" class="w-full mt-2"></x-jet-input>
                    <x-jet-input-error for="precio"></x-jet-input-error>

                    <x-jet-label class="mt-2">Stock</x-jet-label>
                    <x-jet-input name="stock" type="number" step="1" placeholder="Introduce el stock..." value="{{old('stock')}}" class="w-full mt-2"></x-jet-input>
                    <x-jet-input-error for="stock"></x-jet-input-error>

                    <x-jet-label class="mt-2">Imagen</x-jet-label>
                    <x-jet-input name="imagen" type="file" id="file" placeholder="Selecciona una imagen..." class="w-full mt-2" accept="image/*"></x-jet-input>
                    <x-jet-input-error for="imagen"></x-jet-input-error>

                    <div class="mt-2">
                        <img src="{{Storage::url('noImage.png')}}" id="image" />
                    </div>
                    <div class="mt-2 flex flex-row-reverse">
                        
                        <button type="submit" class="mb-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <i class="mr-2 fas fa-save"></i>Crear
                        </button>

                        <a href="{{route('dashboard')}}" class="mr-2 mb-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            <i class="mr-2 fas fa-xmark"></i>Cancelar
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>

