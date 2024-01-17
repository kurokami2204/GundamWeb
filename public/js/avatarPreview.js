// this variable will store images for preview
var images = [];

// this function will select images
function avatar_select() {
    var image = document.getElementById('link_img').files;
    for (i = 0; i < image.length; i++) {
        images[0] = {
            "name" : image[i].name,
            "url" : URL.createObjectURL(image[i]),
            "file" : image[i],
        }
    }
    document.getElementById('avatar_container').innerHTML = avatar_show();
}

// this function will show images in the DOM
function avatar_show() {
    var item = "";
    images.forEach((i) => {
        item = `
            <div class="relative w-full h-full flex justify-center items-center">
                <img src="`+ i.url +`" alt="Image" class="h-full w-full object-contain">
                <span class="absolute text-2xl text-red-500 cursor-pointer
                            right-5 top-5 rounded-full border-white bg-white px-2 py-1
                            flex justify-center items-center text-center
                            fa-solid fa-circle-x z-10
                            hover:text-white hover:border-red-500 hover:bg-red-500"
                            onclick="delete_avatar(`+ images.indexOf(i) +`)">
                    &times;
                </span>
            </div>`;
        document.getElementById('avatar_container').classList.add('w-full', 'h-full');
    })
    if(images.length == 0){
        item = `
            <div class="flex flex-col items-center ">
                <i class="fas fa-cloud-upload-alt fa-3x text-gray-300"></i>
                <span class="block text-gray-400 font-normal">
                    Attach you files here
                </span>
                <span class="block text-gray-400 font-normal">
                    or
                </span>
                <span class="block text-blue-400 font-normal">
                    Browse files
                </span>
            </div>`;
        document.getElementById('avatar_container').classList.remove('w-full', 'h-full');
    }
    console.log(images.length);
    return item;
}

// this function will get all images from the array
function get_avatar_img() {
    var form = new FormData()
   for (let index = 0; index < images.length; index++) {
       form.append("file[" + index + "]", images[index]['file']);
   }
   return form;
}

// this function will delete a specific image from the container
function delete_avatar(e) {
    images.splice(e, 1);
    document.getElementById('link_img').value = null;
    document.getElementById('avatar_container').innerHTML = avatar_show();
}
