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
        @session('error')
        <div class="fw-meduim bg-danger-subtle fs-5 p-3 mt-3 rounded">
            {{Session::get('error')}}

        </div>
        @endsession

        @csrf
        <div class="row justify-content-start">
            <div class="col-sm-6 col-md-4 col-xl-3 p-3 my-3 picture clickable">
                <div class=" border border-3 border-secondary rounded dashed h-100 d-flex justify-content-center position-relative align-items-center hover-create" id="add-picture" >
                    <div class="position-absolute z-1 text-transparent w-100 h-100">
                    </div>
                    <i class="bi bi-image-fill fw-bolder fs-2"></i>
                </div>
            </div>


            @foreach ($album->getMedia('album') as $pic )
            <div class="col-sm-6 col-md-4 col-xl-3  px-3 py-2 my-2 picture position-relative ">

                    <div class=" border border-2 border-ronud bg-white shadow rounded h-100 p-2 d-flex flex-column position-relative justify-content-center align-items-center clickable fs-3 hover-albums" title="created at: {{ $album->created_at }}">
                        <span>
                            <img src="{{ $pic->getUrl() }}" alt="">
                        </span>
                        <span class="mt-4">
                            {{ $pic->file_name }}

                        </span>
                    </div>

                <div class="position-absolute top-0 end-0 m-3 rounded-end-circle flag d-flex position-relative justify-content-center align-items-center text-danger px-2 fs-2">

                        <form action="{{ route('pictures.delete',$pic->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button>
                                <i class="bi bi-trash-fill hover-edit delete clickable "></i>
                            </button>
                        </form>
                </div>

            </div>

            @endforeach


        </div>
        <div class="pop-up d-flex justify-content-center align-items-center position-relative " id="confirm_pop_up" >
            <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_confirm_pop_up"></div>
            <form action="{{ route('pictures.store',$album) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-around standard-box-z-index ">
                        <div class=" fs-4 fw-bolder text-secondary">
                            <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_confirm_pop_up"></i>
                        </div>
                        <input id="file-upload" class="position-absolute z-n1" name="pictures[]" type="file" accept="image/*" multiple onchange="choosedFiles()" hidden />
                    <p class="p-0 m-0 text-center w-100 fs-3 fw-meduim">Confirm your selection</p>
                    <div class="text-center ">
                        <button class="btn btn-success">confirm</button>
                    </div>
                </div>
            </form>
            </div>


    </div>




    <div class="pop-up d-flex justify-content-center align-items-center position-relative {{ $errors->get('name')? 'show-pop-up':''  }}" id="pop_up" >
        <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_pop_up"></div>
        <form action="{{route('albums.update',$album)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-between standard-box-z-index ">
                <div class=" fs-4 fw-bolder text-secondary">
                <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_pop_up"></i>
            </div>
            <div>
                <x-input-label for="new_album" :value="__('Album')" />
                <x-text-input id="new_album" class="block mt-1 w-full input" type="text" name="name" maxLength="255" max="1" :value="old('name',$album->name)" placeholder="Name"  autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="text-center ">
                <button class="btn btn-success">Edit</button>
            </div>
        </form>
        </div>
    </div>




    <script>
        let editBtn = document.getElementById('edit-album');
        let popup = document.getElementById('pop_up');
        let darkPopup = document.getElementById('dark_pop_up');
        let closePopup = document.getElementById('close_pop_up');
        let addBtn = document.getElementById('add-picture');
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

    <script>
        let confirm_popup = document.getElementById('confirm_pop_up');
        let confirm_darkPopup = document.getElementById('dark_confirm_pop_up');
        let confirm_closePopup = document.getElementById('close_confirm_pop_up');

        function choosedFiles(){
            confirm_popup.classList.add('show-pop-up');

        }

        confirm_darkPopup.addEventListener('click', function(){
            confirm_popup.classList.remove('show-pop-up');

        })
        confirm_closePopup.addEventListener('click', function(){
            confirm_popup.classList.remove('show-pop-up');
        });

    </script>
</x-app-layout>
