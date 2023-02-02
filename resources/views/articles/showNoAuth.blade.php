<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="max-w-sm w-full lg:max-w-full lg:flex">
                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                    style="background-image: url({{Storage::url($article->imagen)}})" title="Woman holding a mug">
                </div>
                <div
                    class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <div class="text-gray-900 font-bold text-xl mb-2">{{$article->nombre}}</div>
                        <p class="mt-2 text-gray-700 text-base">{{$article->descripcion}}</p>
                        <p class="mt-4 text-gray-700 text-base"><b>Precio (€): </b>{{$article->precio}}</p>
                        <p class="text-gray-700 text-base"><b>Stock: </b>{{$article->stock}}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="text-sm">
                            <p class="text-gray-600"><b>Fecha de creación: </b>{{$article->created_at->format('d/m/Y h:i:s')}}</p>
                            <p class="text-gray-600"><b>Fecha de actualización: </b>{{$article->updated_at->format('d/m/Y h:i:s')}}</p>
                            <p class="mt-2 text-gray-900 leading-none">By <u>{{$article->user->name}} ({{$article->user->email}})</u></p>
                        </div>
                    </div>
                    <div class="flex flex-row-reverse mt-4">
                        {{--le indico que me redirija a mi ruta anterior (así si viene de dashboard redirigiré ahí y si viene del welcome redirigiré a welcome)--}}
                        <a href="{{redirect()->back()->getTargetUrl()}}" class="mb-2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"> 
                            <i class="fas fa-backward"></i> Volver 
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>