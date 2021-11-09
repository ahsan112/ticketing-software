<div class="p-4 border-b-2"> 
    <h3 class="text-lg font-medium leading-6 text-gray-900">Add Document</h3>
</div>
<div class="p-3 mb-8">
    <div class="mb-2"> 
        <x-label>Title</x-label>
        <x-input name="title" type="text" class="px-3 w-full border-gray-200 border rounded focus:outline-none focus:border-gray-300" /> 
    </div>
    <div class="mb-2"> 
        <x-label>Attachments</x-label>
        <div class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
            <div class="absolute">
                <div class="flex flex-col items-center "> 
                    <i class="fa fa-cloud-upload fa-3x text-gray-200"></i> 
                    <span class="block text-gray-400 font-normal">Attach you files here</span> 
                    <span class="block text-gray-400 font-normal">or</span> 
                    <span class="block text-blue-400 font-normal">Browse files</span> 
                </div>
            </div> 
            <x-input type="file" class="h-full w-full opacity-0" name="file" />
        </div>
        <div class="flex justify-between items-center text-gray-400"> 
            <span>Accepted file type:.doc .docx .pdf</span> 
            <span class="flex items-center "><i class="fa fa-lock mr-1"></i> secure</span> 
        </div>
    </div>
    <div class="mt-3 text-center pb-3"> 
        <x-button class="w-full text-center justify-center">Upload</x-button>
    </div>
</div>