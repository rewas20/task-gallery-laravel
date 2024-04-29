<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Albums') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-sm-6 col-md-4 col-xl-3 p-3 my-3 picture">
                <div class=" border border-3 border-secondary border-ronud dashed h-100 d-flex justify-content-center align-items-center clickable" id="add-picture" >
                    <div class="fs-1 fw-bolder text-secondary">
                        <i class="bi bi-plus-square-dotted "></i>
                    </div>
                </div>
                <input id="file-upload" name="file" type="file" accept="image/*" hidden/>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 p-3 my-3 picture">
                <div class=" border border-2 border-ronud h-100">

                </div>

            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 p-3 my-3 picture">
                <div class=" border border-2 border-ronud h-100">

                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 p-3 my-3 picture">
                <div class=" border border-2 border-ronud h-100">

                </div>
            </div>
        </div>
    </div>


    <div class="pop-up d-flex justify-content-center align-items-center position-relative" id="pop_up">
        <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_pop_up"></div>
        <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-around standard-box-z-index ">
            <div class=" fs-4 fw-bolder text-secondary">
                <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_pop_up"></i>
            </div>
            <div>
                <x-input-label for="new_album" :value="__('New Album')" />
                <x-text-input id="new_album" class="block mt-1 w-full input" type="text" name="new_album" :value="old('new_album')" placeholder="New Album" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('new_album')" class="mt-2" />
            </div>

            <div class="text-center ">
                <a href="#" class="btn btn-success">Create</a>
            </div>
        </div>
    </div>
</x-app-layout>
