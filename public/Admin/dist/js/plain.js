const addCatSubmitUI = document.querySelector('.addCatSubmit');

const storeData = async function(){
    fetch('http://127.0.0.1:8000/admin/category',{
        method:'POST',
    });
}


const selectFormData = function (){
    const name = document.querySelector('#name').value;
    const slug = document.querySelector('#slug').value;
    const description = document.querySelector('#description').value;

    console.log(name,slug,description);
}
addCatSubmitUI.addEventListener('click',selectFormData);
