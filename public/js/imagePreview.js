// this variable will store images for preview
var images = [];

// this function will select images
function image_select() {
    var image = document.getElementById('linkImg').files;
    for (i = 0; i < image.length; i++) {
          if (check_duplicate(image[i].name)) {
     images.push({
                  "name" : image[i].name,
                  "url" : URL.createObjectURL(image[i]),
                  "file" : image[i],
            })
          } else
          {
               alert(image[i].name + " is already added to the list");
          }
    }

    // document.getElementById('form').reset();
    console.log(image.value);
    document.getElementById('container').style.cssText = 'height: 300px;';
    document.getElementById('container').innerHTML = image_show();
}

// this function will show images in the DOM
function image_show() {
    var image = "";
    images.forEach((i) => {
         image += `
         <div class="image_container flex justify-center relative">
                <img src="`+ i.url +`" alt="Image">
                <span class="absolute text-2xl text-red-500 cursor-pointer
                             right-5 top-5 rounded-full border-white bg-white px-2 py-1
                             flex justify-center items-center text-center
                             fa-solid fa-circle-x
                             hover:text-white hover:border-red-500 hover:bg-red-500"
                            onclick="delete_image(`+ images.indexOf(i) +`)">
                    &times;
                </span>
          </div>`;
    })
    if(images.length == 0){
        document.getElementById('container').style.cssText = 'height: 0px;'
    }
    return image;
}

// this function will get all images from the array
function get_image_data() {
    var form = new FormData()
   for (let index = 0; index < images.length; index++) {
       form.append("file[" + index + "]", images[index]['file']);
   }
   return form;
}

// this function will delete a specific image from the container
function delete_image(e) {
    images.splice(e, 1);
    //xóa 1 ảnh đi nhưng dữ liệu trong thẻ input k xóa đc file đấy do vấn đề bảo mật của thẻ input.
    document.getElementById('container').innerHTML = image_show();
}

// this function will check duplicate images
function check_duplicate(name) {
    var image = true;
    if (images.length > 0) {
        for (e = 0; e < images.length; e++) {
            if (images[e].name == name) {
                image = false;
                break;
            }
        }
    }
    return image;
}
