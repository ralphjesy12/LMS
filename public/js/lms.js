$(function($){

    $('.btn-subject-delete,.btn-lesson-delete').click(function(event){
        var ans = confirm('Are you sure you want to delete this subject?');
        if(!ans){
            event.preventDefault();
            return false;
        }
        return true;
    });

});
