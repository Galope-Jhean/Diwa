const createButton = document.querySelector(".createBtn");
const viewButton = document.querySelector(".viewBtn");
const createForm = document.querySelector(".createEntry");
const viewForm = document.querySelector(".notes");

createButton.addEventListener('click', () => {
    viewForm.style.display = "none";
    createForm.style.display = "block";
    window.location.href = "diary.php";
})

viewButton.addEventListener('click', () => {
    createForm.style.display = "none";
    viewForm.style.display = "grid";
})