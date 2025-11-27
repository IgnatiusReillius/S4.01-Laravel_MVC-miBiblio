<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tus libros') }}
        </h2>
    </x-slot>

    <div class="text-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <x-UI_components.booksViewSelectorBar />
    </div>

    <div class="py-12 dark:text-gray-100">
        <x-book.booksViewDashboard :booksUser="$booksUser"/>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('bookUser.create') }}"> Añadir libro
                </a>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    var li_links = document.querySelectorAll(".links img");
    var view_wraps = document.querySelectorAll(".view_wrap");
    var list_view = document.querySelector(".list-view");
    var list_detailed_view = document.querySelector(".list-detailed-view");
    var grid_small_view = document.querySelector(".grid-small-view");
    var grid_big_view = document.querySelector(".grid-big-view");
    
    li_links.forEach(function(link) {
        link.addEventListener("click", function() {
            li_links.forEach(function(link) {
                link.classList.remove("active");
            })
    
            link.classList.add("active");
            var li_view = link.getAttribute("data-view");
            
            view_wraps.forEach(function(view) {
                view.style.display = "none";
            })
    
            if(li_view == "list-view") {
                list_view.style.display = "block";
            }
            else if(li_view == "list-detailed-view") {
                list_detailed_view.style.display = "block";
            }
            else if(li_view == "grid-small-view") {
                grid_small_view.style.display = "block"; 
            }
            else {
                grid_big_view.style.display = "flex";
            }
        })
    })
</script>
