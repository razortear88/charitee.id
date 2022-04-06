const slug = document.querySelector('#slug');
const nama_kategori = document.querySelector('#nama_kategori');
nama_kategori.addEventListener('change',function(){
  fetch('/admin/kategori/checkSlug?nama=' + nama_kategori.value)
  .then(response => response.json())
  .then(data => slug.value = data.slug)
});
