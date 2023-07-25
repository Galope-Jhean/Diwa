const createButton = document.querySelector(".createBtn");
const viewButton = document.querySelector(".viewBtn");
const createForm = document.querySelector(".createEntry");
const viewForm = document.querySelector(".notes");
const form = document.querySelector('form');


form.addEventListener('submit', e => {
    const title = form.querySelector('input[name="title"]').value;
    const content = form.querySelector('textarea[name="content"]').value

    if(title === '' || content === ''){
        e.preventDefault();
        alert("Please fill in all required fields.");
    }
})


createButton.addEventListener('click', () => {
    viewForm.style.display = "none";
    createForm.style.display = "block";
    window.location.href = "diary.php";
})

viewButton.addEventListener('click', () => {
    createForm.style.display = "none";
    viewForm.style.display = "grid";
})