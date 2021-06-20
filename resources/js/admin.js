require('./bootstrap');

/**
 * Delete post Confirm
 */
const delForm = document.querySelectorAll('.delete-post-form');

delForm.forEach(form => {
    form.addEventListener('submit', function(e){
        const resp = confirm('Are you sure you want to delete?');
        if(!resp){
            e.preventDefault();
        }
    });
})
