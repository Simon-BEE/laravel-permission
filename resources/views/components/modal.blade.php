<div class="overflow-auto bg-gray-900 bg-opacity-25" x-show="isDialogOpen"
:class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }"
>
    <div class="bg-white shadow-2xl rounded my-10 md:my-auto p-4 w-11/12 md:w-6/12" x-show="isDialogOpen" @click.away="isDialogOpen = false" >
        <div class="flex justify-between items-center p-2">
                <h6 class="text-xl font-semibold">{{ $title ?? 'Title props' }}</h6>
                <button class="text-2xl py-1 px-3 -mt-4 rounded hover:bg-gray-200" type="button" @click="isDialogOpen = false" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
        </div>
        <div class="p-2">
            {{ $slot }}
        </div>
    </div>
</div>
