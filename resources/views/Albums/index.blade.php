<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Albums') }}
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
                <div class=" border border-3 border-secondary rounded dashed h-100 d-flex justify-content-center align-items-center clickable hover-create" id="add-album" >
                    <div class="fs-1 fw-bolder text-secondary">
                        <i class="bi bi-plus-square-dotted "></i>
                    </div>
                </div>
            </div>
            @foreach ($albums as $album )

                <div class="col-sm-6 col-md-4 col-xl-3  px-3 py-2 my-2 picture position-relative ">
                    <a href="{{ route('albums.show',$album) }}">
                        <div class=" border border-2 border-ronud bg-white shadow rounded h-100 d-flex position-relative justify-content-center align-items-center clickable fs-3 hover-albums" title="created at: {{ $album->created_at }}">
                            <span class="mt-4">
                                {{ $album->name }}

                            </span>
                            <div class="position-absolute top-0 start-0 rounded-end-circle bg-dark flag d-flex position-relative justify-content-center align-items-center text-white px-2">
                                <i class="bi bi-folder2-open  hover-edit"></i>
                            </div>
                        </div>
                    </a>
                    <div class="position-absolute top-0 end-0 m-3 rounded-end-circle flag d-flex position-relative justify-content-center align-items-center text-danger px-2 fs-2">

                            @if($album->getMedia('album')->first())
                                <button id="delete-btn">
                                    <i class="bi bi-trash-fill hover-edit delete clickable "></i>
                                </button>
                            @else
                                <form action="{{ route('albums.delete',$album->id) }}" method="POST">

                                    @csrf
                                    @method('delete')
                                    <button>
                                        <i class="bi bi-trash-fill hover-edit delete clickable "></i>
                                    </button>
                                </form>
                            @endif
                    </div>

                </div>

                <div class="pop-up d-flex justify-content-center align-items-center position-relative {{ $errors->get('selection')? 'show-pop-up':''  }}" id="move_pop_up" >
                    <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_move_pop_up"></div>
                    <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-around standard-box-z-index move ">
                        <div class=" fs-4 fw-bolder text-secondary">
                            <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_move_pop_up"></i>
                        </div>
                        <h4 class="p-0 m-0 text-center text-danger w-100 fs-3 fw-meduim">Select Folder.</h4>

                        <div class="text-center d-flex justify-content-around">

                                <form action="{{ route('albums.move',$album) }}" method="POST">
                                    @csrf
                                    <select class="my-3" name="selection">
                                        <option selected>Select a folder</option>
                                        @foreach ($albums as $option )
                                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach

                                    </select>
                                    <x-input-error :messages="$errors->get('selection')" class="my-2" />
                                    <button class="btn btn-success">Move</button>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="pop-up d-flex justify-content-center align-items-center position-relative " id="confirm_pop_up" >
                    <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_confirm_pop_up"></div>
                    <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-around standard-box-z-index ">
                        <div class=" fs-4 fw-bolder text-secondary">
                            <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_confirm_pop_up"></i>
                        </div>
                        <h4 class="p-0 m-0 text-center text-danger w-100 fs-3 fw-meduim">This folder non-empty.</h4>

                        <div class="text-center d-flex justify-content-around">
                                <form action="{{ route('albums.delete',$album) }}" method="POST" >
                                        @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete all pictures</button>
                                </form>

                                <button id="move-btn" class="btn btn-success">Move to another album</button>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>




    <div class="pop-up d-flex justify-content-center align-items-center position-relative {{ $errors->get('name')? 'show-pop-up':''  }}" id="pop_up" >
        <div class="position-absolute top-0 start-0 w-100 h-100 dark_pop_up" id="dark_pop_up"></div>
        <form action="{{route('albums.store')}}" method="POST">
            @csrf

            <div class="standard-box bg-white rounded p-3 d-flex flex-column justify-content-around standard-box-z-index ">
                <div class=" fs-4 fw-bolder text-secondary">
                <i class="bi bi-x-square clickable-with-hover-black" title="Close" id="close_pop_up"></i>
            </div>
            <div>
                <x-input-label for="new_album" :value="__('New Album')" />
                <x-text-input id="new_album" class="block mt-1 w-full input" type="text" name="name" maxLength="255" max="1" :value="old('name')" placeholder="Name"  autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="text-center ">
                <button class="btn btn-success">Create</button>
            </div>
        </form>
        </div>
    </div>


<script>
    let addBtn = document.getElementById('add-album');
    let editBtn = document.getElementById('edit-album');
    let popup = document.getElementById('pop_up');
    let darkPopup = document.getElementById('dark_pop_up');
    let closePopup = document.getElementById('close_pop_up');



    addBtn.addEventListener('click', function(){
        popup.classList.add('show-pop-up');
    });

    darkPopup.addEventListener('click', function(){
        popup.classList.remove('show-pop-up');

    })
    closePopup.addEventListener('click', function(){
        popup.classList.remove('show-pop-up');
    });



</script>


<script>
    let btnDelete = document.getElementById('delete-btn');
    let confirm_popup = document.getElementById('confirm_pop_up');
    let confirm_darkPopup = document.getElementById('dark_confirm_pop_up');
    let confirm_closePopup = document.getElementById('close_confirm_pop_up');

    btnDelete.addEventListener('click', function(){
        confirm_popup.classList.add('show-pop-up');

    });

    confirm_darkPopup.addEventListener('click', function(){
        confirm_popup.classList.remove('show-pop-up');

    })
    confirm_closePopup.addEventListener('click', function(){
        confirm_popup.classList.remove('show-pop-up');
    });



</script>

<script>
    let moveBtn = document.getElementById('move-btn');
    let move_popup = document.getElementById('move_pop_up');
    let move_darkPopup = document.getElementById('dark_move_pop_up');
    let move_closePopup = document.getElementById('close_move_pop_up');

    moveBtn.addEventListener('click', function(){
        confirm_popup.classList.remove('show-pop-up');
        move_popup.classList.add('show-pop-up');
    });

    move_darkPopup.addEventListener('click', function(){
        move_popup.classList.remove('show-pop-up');

    })
    move_closePopup.addEventListener('click', function(){
        move_popup.classList.remove('show-pop-up');
    });

</script>
</x-app-layout>


