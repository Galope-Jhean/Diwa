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
    //window.location.href = "diary.php";
})

viewButton.addEventListener('click', () => {
    createForm.style.display = "none";
    viewForm.style.display = "grid";
})

let confirmDelete = noteId => {
    if (confirm("Are you sure you want to delete this note?")) {
        // User clicked OK, proceed with the form submission
        let form = document.createElement('form');
        form.action = 'diary.php';
        form.method = 'POST';

        let inputNoteId = document.createElement('input');
        inputNoteId.type = 'hidden';
        inputNoteId.name = 'note_id';
        inputNoteId.value = noteId;

        let inputAction = document.createElement('input');
        inputAction.type = 'hidden';
        inputAction.name = 'action';
        inputAction.value = 'delete';

        form.appendChild(inputNoteId);
        form.appendChild(inputAction);

        document.body.appendChild(form);
        form.submit();

        return false;
    } else {
        
        return false;
    }
}