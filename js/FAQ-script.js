
const questions = document.querySelectorAll('.question');

questions.forEach( question =>{
    question.addEventListener('click', () => {
        questions.forEach( que => {
            if(que!==question)
            {
                que.classList.remove('active');
                const otherAnswer = que.nextElementSibling;
                otherAnswer.style.display="none" ; 
    
                const Answer = que.nextElementSibling;
                Answer.style.display="none" ; 
                
            }
        });

         question.classList.toggle('active');
         const answer = question.nextElementSibling;


        if (answer.style.display === "block")  
        {
            answer.style.display = "none";
        } 
        else 
        {
            answer.style.display = "block";
        }
    });
    
   });