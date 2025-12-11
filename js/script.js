// atur sidebar exapnsi

const hamburger = document.querySelector("#toggle-btn");

hamburger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
// active nav

//  Menambahkan event listener ketika DOM sudah dimuat
document.addEventListener("DOMContentLoaded", function () {
  // Mengambil semua tautan sidebar
  const sidebarLinks = document.querySelectorAll(".sidebar-link");

  // Iterasi melalui setiap tautan sidebar
  sidebarLinks.forEach(function (link) {
    // Tambahkan event listener untuk setiap tautan
    link.addEventListener("click", function (event) {
      // Hapus kelas 'active' dari semua tautan sidebar
      sidebarLinks.forEach(function (link) {
        link.classList.remove("active");
      });

      // Tambahkan kelas 'active' hanya untuk tautan yang diklik
      this.classList.add("active");
    });
  });

  sidebarLinks.forEach((link) => {
    if (link.href === window.location.href) {
      link.classList.add("active");
    }
  });
});

// document.querySelectorAll('.sidebar-link').forEach(link =>{
//     if(link.href == window.location.href){
//         link.setAttribute('aria-current', 'page')
//     }
// })

//  const btns = document.querySelectorAll('.sidebar-link');

//     btns.forEach(btn => {
//         btn.addEventListener('click', function () {
//             // Menghapus kelas "active" dari semua elemen navigasi
//             btns.forEach(el => {
//                 el.classList.remove('active');
//             });
//             // Menambahkan kelas "active" ke elemen navigasi yang diklik
//             this.classList.add(' active');
//         });
//     });
