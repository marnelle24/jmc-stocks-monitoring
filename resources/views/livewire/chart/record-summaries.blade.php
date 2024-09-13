<div class="grid xl:grid-cols-4 grid-cols-2 xl:gap-6 gap-3 xl:px-0 px-4">
    <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-3 border-b text-center border-gray-200 bg-white">
            <p class="uppercase drop-shadow font-bold text-xs">{{$products['label']}}</p>
        </div>
        <div class="bg-gray-50 bg-opacity-25 p-6 text-center">
            <h1 class="text-4xl">{!!$products['total']!!}</h1>
        </div>
    </div>

    <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-3 border-b text-center border-gray-200 bg-white">
            <p class="uppercase drop-shadow font-bold text-xs">{{$categories['label']}}</p>
        </div>
        <div class="bg-gray-50 bg-opacity-25 p-6 text-center">
            <h1 class="text-4xl">{!!$categories['total']!!}</h1>
        </div>
    </div>

    <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-3 border-b text-center border-gray-200 bg-white">
            <p class="uppercase drop-shadow font-bold text-xs">{{$suppliers['label']}}</p>
        </div>
        <div class="bg-gray-50 bg-opacity-25 p-6 text-center">
            <h1 class="text-4xl">{!!$suppliers['total']!!}</h1>
        </div>
    </div>
    
    <div class="bg-gray-50 overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-3 border-b text-center border-gray-200 bg-white">
            <p class="uppercase drop-shadow font-bold text-xs">{{$users['label']}}</p>
        </div>
        <div class="bg-gray-50 bg-opacity-25 p-6 text-center">
            <h1 class="text-3xl">{!!$users['total']!!}</h1>
        </div>
    </div>
</div>
