jQuery(function($){

    $('.btn-subject-delete,.btn-lesson-delete').click(function(event){
        var ans = confirm('Are you sure you want to delete this subject?');
        if(!ans){
            event.preventDefault();
            return false;
        }
        return true;
    });

    // Exams

    $('#exam-create').delegate('.btn-remove-choice','click',function(event){
        event.preventDefault();

        var $choicecount = $(this).closest('.choices-wrapper').find('.choice-group').length;
        if($choicecount < 4){
            $(this).closest('.choices-wrapper').find('.btn-remove-choice').each(function(){
                $(this).addClass('is-disabled');
            });
        }

        $(this).closest('.choice-group').fadeOut(function(){
            $(this).remove();


            updateInputNamesExam();
        });

        // Checking choice count

    });
    $('#exam-create').delegate('.btn-add-choices','click',function(event){
        event.preventDefault();
        var $choice = $(this).closest('.choices-wrapper').find('.choice-group').last().clone();
        $choice.find('input[type="text"]').first().val('');
        $choice.insertAfter($(this).closest('.choices-wrapper').find('.choice-group').last());

        // Checking choice count

        var $choicecount = $(this).closest('.choices-wrapper').find('.choice-group').length;
        if($choicecount > 2){
            $(this).closest('.choices-wrapper').find('.btn-remove-choice').each(function(){
                $(this).removeClass('is-disabled');
            });
        }


        updateInputNamesExam();
    });
    $('#exam-create').delegate('.btn-add-questions','click',function(event){
        event.preventDefault();
        var $question = $('#exam-create').find('.question-group').last().clone();
        $question.find('.choice-group:gt(1)').remove();
        $question.find('.textarea,.input').val('');
        $question.find('input[type="checkbox"]').prop('checked',false);
        $question.find('.btn-remove-choice').each(function(){
            $(this).addClass('is-disabled');
        });
        $question.insertAfter($('#exam-create').find('.question-group').last());

        // Checking question count

        var $questiongroups = $('#exam-create').find('.question-group');
        if($questiongroups.length > 1){
            $questiongroups.find('.btn-delete-question').each(function(){
                $(this).removeClass('is-disabled');
            });
        }


        updateInputNamesExam();



    });

    $('#exam-create').delegate('.btn-delete-question','click',function(event){
        event.preventDefault();

        // Checking question count
        var $questiongroups = $('#exam-create').find('.question-group');
        if($questiongroups.length < 3){
            $questiongroups.find('.btn-delete-question').each(function(){
                $(this).addClass('is-disabled');
            });
        }


        $(this).closest('.question-group').fadeOut(function(){
            $(this).remove();
            updateInputNamesExam();
        });

    });

    function updateInputNamesExam(){
        // Update Input names
        var $questiongroups = $('#exam-create').find('.question-group');
        $questiongroups.each(function(i){
            $(this).find('.input-question').attr('name','question['+i+']');
            $(this).find('.choice-group').each(function(ii,vv){
                $(this).find('.input-answer').each(function(iii,vvv){
                    $(this).attr('name','answer['+i+'][]');
                    $(this).attr('value',ii);
                });
                $(this).find('.input-choice').each(function(iii,vvv){
                    $(this).attr('name','choice['+i+']['+ii+']');
                });
            });
        });
    }

    // Quizzes


    $('#quiz-create').delegate('.btn-remove-choice','click',function(event){
        event.preventDefault();

        var $choicecount = $(this).closest('.choices-wrapper').find('.choice-group').length;
        if($choicecount < 4){
            $(this).closest('.choices-wrapper').find('.btn-remove-choice').each(function(){
                $(this).addClass('is-disabled');
            });
        }

        $(this).closest('.choice-group').fadeOut(function(){
            $(this).remove();


            updateInputNamesQuiz();
        });

        // Checking choice count

    });
    $('#quiz-create').delegate('.btn-add-choices','click',function(event){
        event.preventDefault();
        var $choice = $(this).closest('.choices-wrapper').find('.choice-group').last().clone();
        $choice.find('input[type="text"]').first().val('');
        $choice.insertAfter($(this).closest('.choices-wrapper').find('.choice-group').last());

        // Checking choice count

        var $choicecount = $(this).closest('.choices-wrapper').find('.choice-group').length;
        if($choicecount > 2){
            $(this).closest('.choices-wrapper').find('.btn-remove-choice').each(function(){
                $(this).removeClass('is-disabled');
            });
        }


        updateInputNamesQuiz();
    });
    $('#quiz-create').delegate('.btn-add-questions','click',function(event){
        event.preventDefault();
        var $question = $('#quiz-create').find('.question-group').last().clone();
        $question.find('.choice-group:gt(1)').remove();
        $question.find('.textarea,.input').val('');
        $question.find('input[type="checkbox"]').prop('checked',false);
        $question.find('.btn-remove-choice').each(function(){
            $(this).addClass('is-disabled');
        });
        $question.insertAfter($('#quiz-create').find('.question-group').last());

        // Checking question count

        var $questiongroups = $('#quiz-create').find('.question-group');
        if($questiongroups.length > 1){
            $questiongroups.find('.btn-delete-question').each(function(){
                $(this).removeClass('is-disabled');
            });
        }


        updateInputNamesQuiz();



    });

    $('#quiz-create').delegate('.btn-delete-question','click',function(event){
        event.preventDefault();

        // Checking question count
        var $questiongroups = $('#quiz-create').find('.question-group');
        if($questiongroups.length < 3){
            $questiongroups.find('.btn-delete-question').each(function(){
                $(this).addClass('is-disabled');
            });
        }


        $(this).closest('.question-group').fadeOut(function(){
            $(this).remove();
            updateInputNamesQuiz();
        });

    });

    function updateInputNamesQuiz(){
        // Update Input names
        var $questiongroups = $('#quiz-create').find('.question-group');
        $questiongroups.each(function(i){
            $(this).find('.input-question').attr('name','question['+i+']');
            $(this).find('.choice-group').each(function(ii,vv){
                $(this).find('.input-answer').each(function(iii,vvv){
                    $(this).attr('name','answer['+i+'][]');
                    $(this).attr('value',ii);
                });
                $(this).find('.input-choice').each(function(iii,vvv){
                    $(this).attr('name','choice['+i+']['+ii+']');
                });
            });
        });
    }
    
});
