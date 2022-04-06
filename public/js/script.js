function previewImages() {

    const preview = document.querySelector('#preview');
    const first = preview.firstElementChild;
    
    while (first) {
        first.remove();
        first = preview.firstElementChild;
    }
    
    if (this.files) {
       var dt= new DataTransfer();
      [].forEach.call(this.files, readAndPreview);
      document.querySelector("#gambar").files= dt.files;
    }
  
    function readAndPreview(file) {
      if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
        return alert(file.name + " is not an image");
      } // else...
      dt.items.add(file);
      
      var reader = new FileReader();
      
      reader.addEventListener("load", function() {
        var image = new Image();
        image.height = 100;
        image.title  = file.name;
        image.src    = this.result;
        preview.appendChild(image);
      });
      
      reader.readAsDataURL(file); 
    }  
}

const slug = document.querySelector('#slug');
const nama_panti = document.querySelector('#nama_panti');
nama_panti.addEventListener('change',function(){
  fetch('/admin/panti/checkSlug?nama=' + nama_panti.value)
  .then(response => response.json())
  .then(data => slug.value = data.slug)
});

const result = document.getElementById('result');
document.querySelector("#gambar").addEventListener('change',previewImages);
