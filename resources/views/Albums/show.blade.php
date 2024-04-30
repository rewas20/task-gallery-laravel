<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="me-2">
                <i class="bi bi-pen me-4 clickable hover-edit fs-3" id="edit-album"></i>
            </span>
            {{ $album->name }}
        </h2>
    </x-slot>


    <div class="container px-3">
        @session('success')
        <div class="fw-meduim bg-success-subtle fs-5 p-3 mt-3 rounded">
            {{Session::get('success')}}

        </div>
        @endsession

        <div class="row justify-content-start">
            <div class="col-sm-6 col-md-4 col-xl-3 p-3 my-3 picture">
                <div class=" border border-3 border-secondary rounded dashed h-100 d-flex justify-content-center align-items-center clickable hover-create" id="add-picture" >
                    <div class="fs-1 fw-bolder text-secondary">
                        <i class="bi bi-plus-square-dotted "></i>
                    </div>
                </div>
                <input id="file-upload" name="file" type="file" accept="image/*" hidden/>
            </div>


        </div>
    </div>


    <div class="pop-up d-flex justify-content-center align-items-center position-relative {{ $errors->get('name')? 'show-pop-up':''  }}" id="pop_up" >
        <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_pop_up"></div>
        <form action="{{route('albums.update',$album)}}" method="POST">
            @csrf

            <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-around standard-box-z-index ">
                <div class=" fs-4 fw-bolder text-secondary">
                <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_pop_up"></i>
            </div>
            <div>
                <x-input-label for="new_album" :value="__('Album')" />
                <x-text-input id="new_album" class="block mt-1 w-full input" type="text" name="name" maxLength="255" max="1" :value="old('name',$album->name)" placeholder="Name"  autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="text-center ">
                <button class="btn btn-success">Edit</button>
            </div>
        </form>
        </div>
    </div>




</x-app-layout>
<script>
    let editBtn = document.getElementById('edit-album');
    let popup = document.getElementById('pop_up');
    let darkPopup = document.getElementById('dark_pop_up');
    let closePopup = document.getElementById('close_pop_up');
    let fileBtn = document.getElementById('file-upload');



    editBtn.addEventListener('click', function(){
        popup.classList.add('show-pop-up');
    });

    darkPopup.addEventListener('click', function(){
        popup.classList.remove('show-pop-up');

    })
    closePopup.addEventListener('click', function(){
        popup.classList.remove('show-pop-up');
    });

    addBtn.addEventListener('click', function(){
        fileBtn.click();
    });

</script>
